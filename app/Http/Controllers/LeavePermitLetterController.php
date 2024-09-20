<?php

namespace App\Http\Controllers;

use App\Events\Activity;
use App\Events\LetterRejected;
use App\Events\LetterVerified;
use App\Models\LeavePermitLetter;
use App\Models\Letter;
use App\Models\User;
use Illuminate\Http\Request;

class LeavePermitLetterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        gate('read-leave-permit-letter');

        $leavePermitLetters = LeavePermitLetter::orderBy('created_at', 'DESC')->get();

        return view('leave-permit-letter.index', [
            'leavePermitLetters' => $leavePermitLetters
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        gate('create-leave-permit-letter');

        $users = User::active()->get();

        return view('leave-permit-letter.create', [
            'users' => $users,
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
        gate('create-leave-permit-letter');

        $data = $request->validate([
            'user_id' => ['required', 'uuid'],
            'regarding' => ['required', 'max:50'],
            'attachment' => ['required', 'max:50'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'after_or_equal:start_date'],
            'reason' => ['required'],
        ]);

        $leavePermitLetter = new LeavePermitLetter;
        $leavePermitLetter->user_id = $data['user_id'];
        $leavePermitLetter->regarding = $data['regarding'];
        $leavePermitLetter->attachment = $data['attachment'];
        $leavePermitLetter->start_date = $data['start_date'];
        $leavePermitLetter->end_date = $data['end_date'];
        $leavePermitLetter->reason = $data['reason'];
        $leavePermitLetter->save();
        $leavePermitLetter->letter()->save(new Letter([
            'note' => 'Surat telah dibuat dan menunggu untuk diverifikasi'
        ]));

        Activity::dispatch('membuat surat izin cuti');

        return to_route('leave-permit-letter.index')->with('swal.success', 'Surat izin cuti berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LeavePermitLetter  $leavePermitLetter
     * @return \Illuminate\Http\Response
     */
    public function show(LeavePermitLetter $leavePermitLetter)
    {
        gate('read-leave-permit-letter');

        return view('leave-permit-letter.show', [
            'leavePermitLetter' => $leavePermitLetter
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LeavePermitLetter  $leavePermitLetter
     * @return \Illuminate\Http\Response
     */
    public function edit(LeavePermitLetter $leavePermitLetter)
    {
        gate('update-leave-permit-letter');

        $users = User::active()->get();

        return view('leave-permit-letter.edit', [
            'leavePermitLetter' => $leavePermitLetter,
            'users' => $users,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LeavePermitLetter  $leavePermitLetter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LeavePermitLetter $leavePermitLetter)
    {
        gate('update-leave-permit-letter');

        $data = $request->validate([
            'user_id' => ['required', 'uuid'],
            'regarding' => ['required', 'max:50'],
            'attachment' => ['required', 'max:50'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'after_or_equal:start_date'],
            'reason' => ['required'],
        ]);

        $leavePermitLetter->user_id = $data['user_id'];
        $leavePermitLetter->regarding = $data['regarding'];
        $leavePermitLetter->attachment = $data['attachment'];
        $leavePermitLetter->start_date = $data['start_date'];
        $leavePermitLetter->end_date = $data['end_date'];
        $leavePermitLetter->reason = $data['reason'];
        $leavePermitLetter->save();

        Activity::dispatch('memperbarui surat izin cuti');

        return to_route('leave-permit-letter.show', ['leavePermitLetter' => $leavePermitLetter])
            ->with('swal.success', 'Surat izin cuti berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LeavePermitLetter  $leavePermitLetter
     * @return \Illuminate\Http\Response
     */
    public function destroy(LeavePermitLetter $leavePermitLetter)
    {
        gate('delete-leave-permit-letter');

        if ($signature = $leavePermitLetter->letter->signature) {
            $signature->delete();
        }
        $leavePermitLetter->delete();
        $leavePermitLetter->letter()->delete();

        Activity::dispatch('menghapus surat izin cuti');

        return to_route('leave-permit-letter.index')
            ->with('swal.success', 'Surat izin cuti berhasil dihapus');
    }

    public function verify(Request $request, LeavePermitLetter $leavePermitLetter)
    {
        gate('update-leave-permit-letter-verification');

        if ($leavePermitLetter->letter->verified()) {
            return back()->with('swal.warning', 'Surat sudah diverifikasi');
        } elseif ($leavePermitLetter->letter->rejected()) {
            return back()->with('swal.warning', 'Tidak dapat memverifikasi surat yang telah ditolak');
        }

        $data = $request->validate([
            'note' => ['nullable', 'string', 'max:1000', 'min:5'],
        ]);

        $leavePermitLetter->letter->verify($data['note'], [
            "Jenis" => "Surat Izin Cuti",
            "Perhal" => $leavePermitLetter->regarding,
            "Yang Mengajukan Cuti" => $leavePermitLetter->user->name,
            "Alasan Cuti" => $leavePermitLetter->reason,
        ]);

        LetterVerified::dispatch(LeavePermitLetter::class, $leavePermitLetter);

        Activity::dispatch('memverifikasi surat izin cuti');

        return to_route('leave-permit-letter.show', ['leavePermitLetter' => $leavePermitLetter])
            ->with('swal.success', 'Surat berhasil diverifikasi');
    }

    public function reject(Request $request, LeavePermitLetter $leavePermitLetter)
    {
        gate('update-leave-permit-letter-verification');

        if ($leavePermitLetter->letter->rejected()) {
            return back()->with('swal.warning', 'Surat sudah ditolak');
        } elseif ($leavePermitLetter->letter->verified()) {
            return back()->with('swal.warning', 'Tidak dapat menolak surat yang telah diverifikasi');
        }

        $data = $request->validate([
            'note' => ['nullable', 'string', 'max:1000', 'min:5'],
        ]);

        $leavePermitLetter->letter->reject($data['note']);

        LetterRejected::dispatch(LeavePermitLetter::class, $leavePermitLetter);

        Activity::dispatch('menolak surat izin cuti');

        return to_route('leave-permit-letter.show', ['leavePermitLetter' => $leavePermitLetter])
            ->with('swal.success', 'Surat telah ditolak');
    }

    public function print(LeavePermitLetter $leavePermitLetter)
    {
        gate('read-leave-permit-letter');

        if (!$leavePermitLetter->letter->verified()) {
            return back()->with('swal.warning', 'Tidak dapat mencetak surat yang tidak terverifikasi');
        }

        config(['page.title' => 'Surat Izin Cuti']);

        $signature = $leavePermitLetter->letter->signature;
        $decoded = json_decode($signature->payload, true);
        $url = url(route('signature.check', ['signature' => $signature]));

        return view('leave-permit-letter.print', [
            'leavePermitLetter' => $leavePermitLetter,
            'decoded' => $decoded,
            'url' => $url
        ]);
    }
}
