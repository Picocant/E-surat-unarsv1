<?php

namespace App\Http\Controllers;

use App\Events\Activity;
use App\Models\IncomingLetter;
use App\Models\IncomingLetterDisposition;
use App\Models\Signature;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class IncomingLetterDispositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        gate('read-incoming-letter-disposition');

        $incomingLetterDispositions = IncomingLetterDisposition::with('incoming_letter')->orderBy('created_at', 'DESC')->get();
        return view('incoming-letter-disposition.index', [
            'incomingLetterDispositions' => $incomingLetterDispositions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        gate('create-incoming-letter-disposition');

        $incomingLetter = IncomingLetter::findOrFail($request->query('incoming_letter_id'));

        if (!is_null($incomingLetter->incoming_letter_disposition)) {
            return back()->with('swal.error', 'Surat sudah memiliki disposisi');
        }

        return view('incoming-letter-disposition.create', [
            'incomingLetter' => $incomingLetter,
            'types' => IncomingLetterDisposition::TYPES
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
        gate('create-incoming-letter-disposition');

        $incomingLetter = IncomingLetter::findOrFail($request->query('incoming_letter_id'));

        if (!is_null($incomingLetter->incoming_letter_disposition)) {
            return back()->with('swal.error', 'Surat sudah memiliki disposisi');
        }

        $data = $request->validate([
            'to' => ['required', 'max:128'],
            'type' => ['required', Rule::in(IncomingLetterDisposition::TYPES)],
            'message' => ['required'],
        ]);

        $incomingLetterDisposition = IncomingLetterDisposition::create([
            'incoming_Letter_id' => $incomingLetter->id,
            'to' => $data['to'],
            'type' => $data['type'],
            'message' => $data['message'],
        ]);

        $incomingLetterDisposition->signature()->save(new Signature([
            'payload' => Signature::buildPayload([
                'Tipe' => 'Disposisi Surat',
                'Nomor Surat' => $incomingLetter->letter_number,
                'Perihal Surat' => $incomingLetter->regarding,
                'Tujuan Disposisi' => $incomingLetterDisposition->to,
                'Isi Disposisi' => $incomingLetterDisposition->message,
            ])
        ]));

        Activity::dispatch('membuat disposisi surat masuk');

        return to_route('incoming-letter-disposition.index')->with('swal.success', 'Disposisi surat berhasil ditambahkan');
    }

    public function show(IncomingLetterDisposition $incomingLetterDisposition)
    {
        gate('read-incoming-letter-disposition');

        return view('incoming-letter-disposition.show', [
            'incomingLetterDisposition' => $incomingLetterDisposition
        ]);
    }

    public function edit(Request $request, IncomingLetterDisposition $incomingLetterDisposition)
    {
        gate('update-incoming-letter-disposition');

        $incomingLetter = IncomingLetter::findOrFail($request->query('incoming_letter_id'));

        if (!is_null($incomingLetter->incoming_letter_disposition)) {
            if ($incomingLetter->incoming_letter_disposition->id != $incomingLetterDisposition->id) {
                return back()->with('swal.error', 'Surat sudah memiliki disposisi');
            }
        }

        return view('incoming-letter-disposition.edit', [
            'incomingLetter' => $incomingLetter,
            'types' => IncomingLetterDisposition::TYPES,
            'incomingLetterDisposition' => $incomingLetterDisposition
        ]);
    }

    public function update(Request $request, IncomingLetterDisposition $incomingLetterDisposition)
    {
        gate('update-incoming-letter-disposition');

        $incomingLetter = IncomingLetter::findOrFail($request->query('incoming_letter_id'));

        if (!is_null($incomingLetter->incoming_letter_disposition)) {
            if ($incomingLetter->incoming_letter_disposition->id != $incomingLetterDisposition->id) {
                return back()->with('swal.error', 'Surat sudah memiliki disposisi');
            }
        }

        $data = $request->validate([
            'to' => ['required', 'max:128'],
            'type' => ['required', Rule::in(IncomingLetterDisposition::TYPES)],
            'message' => ['required'],
        ]);

        $incomingLetterDisposition->incoming_letter_id = $incomingLetter->id;
        $incomingLetterDisposition->to = $data['to'];
        $incomingLetterDisposition->type = $data['type'];
        $incomingLetterDisposition->message = $data['message'];
        $incomingLetterDisposition->save();

        Activity::dispatch('memperbarui disposisi surat masuk');

        return to_route('incoming-letter-disposition.show', ['incomingLetterDisposition' => $incomingLetterDisposition])
            ->with('swal.success', 'Disposisi berhasil diperbarui');
    }

    public function destroy(IncomingLetterDisposition $incomingLetterDisposition)
    {
        gate('delete-incoming-letter-disposition');

        $incomingLetterDisposition->delete();

        Activity::dispatch('menghapus disposisi surat masuk');

        return to_route('incoming-letter-disposition.index')->with('swal.success', 'Disposisi surat masuk telah dihapus');
    }

    public function print(IncomingLetterDisposition $incomingLetterDisposition)
    {
        gate('read-incoming-letter-disposition');

        config(['page.title' => 'Lembar Disposisi Surat - ' . $incomingLetterDisposition->incoming_letter->letter_number]);

        $signature = $incomingLetterDisposition->signature;
        $decoded = json_decode($signature->payload, true);
        $url = url(route('signature.check', ['signature' => $signature]));

        return view('incoming-letter-disposition.print', [
            'incomingLetterDisposition' => $incomingLetterDisposition,
            'decoded' => $decoded,
            'url' => $url
        ]);
    }
}
