<?php

namespace App\Http\Controllers;

use App\Events\Activity;
use App\Events\LetterCreated;
use App\Events\LetterRejected;
use App\Events\LetterVerified;
use App\Models\Letter;
use App\Models\SppdLetter;
use App\Models\SppdLetterRecipient;
use App\Models\User;
use Illuminate\Http\Request;

class SppdLetterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        gate('read-sppd-letter');

        $sppdLetters = SppdLetter::with('recipients')->orderBy('created_at', 'DESC')->get();

        return view('sppd-letter.index', [
            'sppdLetters' => $sppdLetters
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        gate('create-sppd-letter');
        $users = User::active()->get();

        return view('sppd-letter.create', [
            'users' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        gate('create-sppd-letter');

        $data = $request->validate([
            'from_user_id' => ['required', 'uuid'],
            'budget' => ['required', 'numeric', 'min:0'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'after_or_equal:start_date'],
            'purpose' => ['required'],
            'destination' => ['required'],
            'recipient_ids' => ['required'],
            'recipient_ids.*' => ['required', 'uuid'],
        ]);

        $sppdLetter = SppdLetter::create([
            'from_user_id' => $data['from_user_id'],
            'budget' => $data['budget'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'purpose' => $data['purpose'],
            'destination' => $data['destination'],
        ]);

        $sppdLetter->letter()->save(new Letter([
            'note' => 'Surat telah dibuat dan menunggu untuk diverifikasi'
        ]));

        foreach ($data['recipient_ids'] as $recipientId) {
            $recipient = new SppdLetterRecipient();
            $recipient->sppd_letter_id = $sppdLetter->id;
            $recipient->user_id = $recipientId;
            $recipient->save();
        }

        LetterCreated::dispatch(SppdLetter::class, $sppdLetter);

        Activity::dispatch('membuat surat perintah perjalanan dinas');

        return to_route('sppd-letter.index')->with('swal.success', 'Surat berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SppdLetter  $sppdLetter
     * @return \Illuminate\Http\Response
     */
    public function show(SppdLetter $sppdLetter)
    {
        gate('read-sppd-letter');

        return view('sppd-letter.show', [
            'sppdLetter' => $sppdLetter,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SppdLetter  $sppdLetter
     * @return \Illuminate\Http\Response
     */
    public function edit(SppdLetter $sppdLetter)
    {
        gate('update-sppd-letter');

        return view('sppd-letter.edit', [
            'sppdLetter' => $sppdLetter,
            'users' => User::active()->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SppdLetter  $sppdLetter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SppdLetter $sppdLetter)
    {
        gate('update-sppd-letter');

        $data = $request->validate([
            'from_user_id' => ['required', 'uuid'],
            'budget' => ['required', 'numeric', 'min:0'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'after_or_equal:start_date'],
            'purpose' => ['required'],
            'destination' => ['required'],
            'recipient_ids' => ['required'],
            'recipient_ids.*' => ['required', 'uuid'],
        ]);

        $sppdLetter->from_user_id = $data['from_user_id'];
        $sppdLetter->budget = $data['budget'];
        $sppdLetter->start_date = $data['start_date'];
        $sppdLetter->end_date = $data['end_date'];
        $sppdLetter->purpose = $data['purpose'];
        $sppdLetter->destination = $data['destination'];
        $sppdLetter->save();
        $sppdLetter->recipients()->delete();
        foreach ($data['recipient_ids'] as $recipientId) {
            $recipient = new SppdLetterRecipient();
            $recipient->sppd_letter_id = $sppdLetter->id;
            $recipient->user_id = $recipientId;
            $recipient->save();

            Activity::dispatch('memperbarui surat perintah perjalanan dinas');
        }

        return to_route('sppd-letter.show', ['sppdLetter' => $sppdLetter])->with('swal.success', 'Surat berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SppdLetter  $sppdLetter
     * @return \Illuminate\Http\Response
     */
    public function destroy(SppdLetter $sppdLetter)
    {
        gate('delete-sppd-letter');

        if ($signature = $sppdLetter->letter->signature) {
            $signature->delete();
        }
        $sppdLetter->delete();
        $sppdLetter->letter()->delete();
        $sppdLetter->recipients()->delete();

        Activity::dispatch('menghapus surat perintah perjalanan dinas');

        return to_route('sppd-letter.index')->with('swal.success', 'Surat perintah perjalanan dinas berhasil dihapus');
    }

    public function verify(Request $request, SppdLetter $sppdLetter)
    {
        gate('update-sppd-letter-verification');

        if ($sppdLetter->letter->verified()) {
            return back()->with('swal.warning', 'Surat sudah diverifikasi');
        } elseif ($sppdLetter->letter->rejected()) {
            return back()->with('swal.warning', 'Tidak dapat memverifikasi surat yang telah ditolak');
        }

        $data = $request->validate([
            'note' => ['nullable', 'string', 'max:1000', 'min:5'],
        ]);

        $sppdLetter->letter->verify($data['note'], [
            "Jenis" => "Surat Perintah Perjalanan Dinas",
            "Yang Memberi Perintah" => $sppdLetter->from->name,
            "Tujuan Perjalanan" => $sppdLetter->destination,
            "Maksud Perjalanan" => $sppdLetter->purpose,
            "Ditujukan Kepada" => $sppdLetter->recipients->map(function ($recipient, $key) {
                return $key + 1 . ") " . $recipient->user->name . ". ";
            })->toArray(),
        ]);

        LetterVerified::dispatch(SppdLetter::class, $sppdLetter);

        Activity::dispatch('memverifikasi surat perintah perjalanan dinas');

        return to_route('sppd-letter.show', ['sppdLetter' => $sppdLetter])
            ->with('swal.success', 'Surat berhasil diverifikasi');
    }

    public function reject(Request $request, SppdLetter $sppdLetter)
    {
        gate('update-sppd-letter-verification');

        if ($sppdLetter->letter->rejected()) {
            return back()->with('swal.warning', 'Surat sudah ditolak');
        } elseif ($sppdLetter->letter->verified()) {
            return back()->with('swal.warning', 'Tidak dapat menolak surat yang telah diverifikasi');
        }

        $data = $request->validate([
            'note' => ['nullable', 'string', 'max:1000', 'min:5'],
        ]);

        $sppdLetter->letter->reject($data['note']);

        LetterRejected::dispatch(SppdLetter::class, $sppdLetter);

        Activity::dispatch('menolak surat perintah perjalanan dinas');

        return to_route('sppd-letter.show', ['sppdLetter' => $sppdLetter])
            ->with('swal.success', 'Surat telah ditolak');
    }

    public function print(SppdLetter $sppdLetter)
    {
        gate('read-sppd-letter');

        if (!$sppdLetter->letter->verified()) {
            return back()->with('swal.warning', 'Tidak dapat mencetak surat yang tidak terverifikasi');
        }

        config(['page.title' => 'Surat Perintah Perjalanan Dinas']);

        $signature = $sppdLetter->letter->signature;
        $decoded = json_decode($signature->payload, true);
        $url = url(route('signature.check', ['signature' => $signature]));

        return view('sppd-letter.print', [
            'sppdLetter' => $sppdLetter,
            'decoded' => $decoded,
            'url' => $url,
        ]);
    }
}
