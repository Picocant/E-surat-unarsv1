<?php

namespace App\Http\Controllers;

use App\Events\Activity;
use App\Models\Archive;
use App\Models\SchoolDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SchoolDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        gate('read-school-document');

        $schoolDocuments = SchoolDocument::with(['archive'])->orderBy('created_at', 'DESC')->get();

        return view('school-document.index', [
            'schoolDocuments' => $schoolDocuments
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        gate('create-school-document');

        return view('school-document.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        gate('create-school-document');

        $data = $request->validate([
            'name' => ['required', 'max:50'],
            'number' => ['required', 'max:50'],
            'date' => ['required', 'date'],
            'file' => ['required', 'file', 'max:10240'],
            'description' => ['nullable'],
        ]);

        if (!$request->file('file')->isValid()) {
            return back()->with('Upload file gagal');
        }

        $schoolDocument = SchoolDocument::create([
            'user_id' => Auth::id(),
            'name' => $data['name'],
            'number' => $data['number'],
            'date' => $data['date'],
            'description' => $data['description'],
            'file' => $request->file('file')->storePublicly('school-documents'),
        ]);

        $schoolDocument->archive()->save(new Archive());

        Activity::dispatch('menambah arsip dokumen sekolah');

        return to_route('school-document.index')->with('swal.success', 'Arsip dokumen sekolah berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SchoolDocument  $schoolDocument
     * @return \Illuminate\Http\Response
     */
    public function show(SchoolDocument $schoolDocument)
    {
        gate('read-school-document');

        return view('school-document.show', [
            'schoolDocument' => $schoolDocument,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SchoolDocument  $schoolDocument
     * @return \Illuminate\Http\Response
     */
    public function edit(SchoolDocument $schoolDocument)
    {
        gate('update-school-document');

        return view('school-document.edit', [
            'schoolDocument' => $schoolDocument,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SchoolDocument  $schoolDocument
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SchoolDocument $schoolDocument)
    {
        gate('update-school-document');

        $data = $request->validate([
            'name' => ['required', 'max:50'],
            'number' => ['required', 'max:50'],
            'date' => ['required', 'date'],
            'file' => ['nullable', 'file', 'max:10240'],
            'description' => ['nullable'],
        ]);

        $schoolDocument->name = $data['name'];
        $schoolDocument->number = $data['number'];
        $schoolDocument->date = $data['date'];
        $schoolDocument->description = $data['description'];
        if ($request->file('file')) {
            Storage::delete($schoolDocument->file);
            $schoolDocument->file = $request->file('file')->storePublicly('school-documents');
        }
        $schoolDocument->save();

        Activity::dispatch('memperbarui arsip dokumen sekolah');

        return to_route('school-document.show', ['schoolDocument' => $schoolDocument])->with('swal.success', 'Arsip dokumen sekolah berhasl diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SchoolDocument  $schoolDocument
     * @return \Illuminate\Http\Response
     */
    public function destroy(SchoolDocument $schoolDocument)
    {
        gate('delete-school-document');

        $schoolDocument->delete();

        Storage::delete($schoolDocument->file);

        Activity::dispatch('menghapus arsip dokumen sekolah');

        return to_route('school-document.index')->with('swal.success', 'Arsip dokumen sekolah berhasil dihapus');
    }
}
