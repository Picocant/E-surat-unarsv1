<?php

namespace App\Http\Controllers;

use App\Events\Activity;
use App\Events\NewIncomingLetter;
use App\Models\IncomingLetter;
use App\Models\IncomingLetterCategory;
use App\Models\IncomingLetterDisposition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IncomingLetterController extends Controller
{
    public function index()
    {
        gate('read-incoming-letter');

        $incomingLetters = IncomingLetter::with('incoming_letter_category')->orderBy('created_at', 'DESC')->get();

        return view('incoming-letter.index', [
            'incomingLetters' => $incomingLetters,
        ]);
    }

    public function show(IncomingLetter $incomingLetter)
    {
        gate('read-incoming-letter');

        return view('incoming-letter.show', [
            'incomingLetter' => $incomingLetter
        ]);
    }

    public function create()
    {
        gate('create-incoming-letter');

        $incomingLetterCategories = IncomingLetterCategory::all();

        return view('incoming-letter.create', [
            'incomingLetterCategories' => $incomingLetterCategories,
        ]);
    }

    public function store(Request $request)
    {
        gate('create-incoming-letter');

        $rules = [
            'letter_number' => ['required', 'max:50'],
            'regarding' => ['required', 'max:50'],
            'attachment' => ['required', 'max:50'],
            'from' => ['required', 'max:50'],
            'to' => ['required', 'max:50'],
            'date' => ['required', 'date'],
            'file' => ['required', 'file', 'max:5120', 'mimetypes:application/pdf']
        ];

        if (IncomingLetterCategory::count() < 1) {
            $rules['category'] = ['required', 'max:30'];
        } else {
            $rules['incoming_letter_category_id'] = ['required', 'uuid'];
        }

        $data = $request->validate($rules);

        if (!$request->file('file')->isValid()) {
            return back()->with('swal.error', 'Upload file gagal')->withInput();
        }

        $file = $request->file('file')->storePublicly('incoming-letters');

        $incoming_letter_category_id = null;

        if (key_exists('incoming_letter_category_id', $data)) {
            $incoming_letter_category_id = $data['incoming_letter_category_id'];
        } else {
            $category = IncomingLetterCategory::create(['name' => $data['category']]);
            $incoming_letter_category_id = $category->id;
        }

        $incomingLetter = IncomingLetter::create([
            'letter_number' => $data['letter_number'],
            'regarding' => $data['regarding'],
            'attachment' => $data['attachment'],
            'from' => $data['from'],
            'to' => $data['to'],
            'date' => $data['date'],
            'incoming_letter_category_id' => $incoming_letter_category_id,
            'file' => $file,
        ]);

        NewIncomingLetter::dispatch($incomingLetter);

        Activity::dispatch('menambahkan surat masuk');

        return to_route('incoming-letter.index')->with('swal.success', 'Data surat masuk berhasil ditambahkan');
    }

    public function edit(IncomingLetter $incomingLetter)
    {
        gate('update-incoming-letter');

        $incomingLetterCategories = IncomingLetterCategory::all();

        return view('incoming-letter.edit', [
            'incomingLetter' => $incomingLetter,
            'incomingLetterCategories' => $incomingLetterCategories,
        ]);
    }

    public function update(Request $request, IncomingLetter $incomingLetter)
    {
        gate('update-incoming-letter');

        $data = $request->validate([
            'letter_number' => ['required', 'max:50'],
            'regarding' => ['required', 'max:50'],
            'attachment' => ['required', 'max:50'],
            'from' => ['required', 'max:50'],
            'to' => ['required', 'max:50'],
            'date' => ['required', 'date'],
            'incoming_letter_category_id' => ['required', 'uuid'],
            'file' => ['nullable', 'file', 'max:5120', 'mimetypes:application/pdf']
        ]);

        $incomingLetter->letter_number = $data['letter_number'];
        $incomingLetter->regarding = $data['regarding'];
        $incomingLetter->attachment = $data['attachment'];
        $incomingLetter->from = $data['from'];
        $incomingLetter->to = $data['to'];
        $incomingLetter->date = $data['date'];
        $incomingLetter->incoming_letter_category_id = $data['incoming_letter_category_id'];
        if ($request->file('file')) {
            Storage::delete($incomingLetter->file);
            $incomingLetter->file = $request->file('file')->storePublicly('incoming-letters');
        }
        $incomingLetter->save();

        Activity::dispatch('memperbarui surat masuk');

        return to_route('incoming-letter.show', ['incomingLetter' => $incomingLetter])->with('swal.success', 'Data surat masuk berhasil diperbarui');
    }

    public function destroy(IncomingLetter $incomingLetter)
    {
        gate('delete-incoming-letter');

        $incomingLetter->incoming_letter_disposition()->delete();
        $incomingLetter->delete();
        Storage::delete($incomingLetter->file);

        IncomingLetterDisposition::where('incoming_letter_id', $incomingLetter->id)->delete();

        Activity::dispatch('menghapus surat masuk');

        return to_route('incoming-letter.index')->with('swal.success', 'Data surat masuk berhasil dihapus');
    }
}
