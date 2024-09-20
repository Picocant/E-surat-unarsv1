<?php

namespace App\Http\Controllers;

use App\Events\Activity;
use App\Models\IncomingLetter;
use App\Models\IncomingLetterCategory;
use Illuminate\Http\Request;

class IncomingLetterCategoryController extends Controller
{
    public function index()
    {
        can('read-incoming-letter-category');

        $categories = IncomingLetterCategory::orderBy('created_at', 'DESC')->get();

        return view('incoming-letter-category.index', [
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        gate('create-incoming-letter-category');

        $data = $request->validate([
            'name' => ['required', 'max:30'],
        ]);

        IncomingLetterCategory::create([
            'name' => $data['name'],
        ]);

        Activity::dispatch('membuat kategori surat masuk');

        return back()->with('swal.success', 'Kategori ' . $data['name'] . ' berhasil dibuat');
    }

    public function update(Request $request, IncomingLetterCategory $incomingLetterCategory)
    {
        gate('update-incoming-letter-category');

        $data = $request->validate([
            'name' => ['required', 'max:30'],
        ]);

        $incomingLetterCategory->name = $data['name'];
        $incomingLetterCategory->save();

        Activity::dispatch('memperbarui kategori surat masuk');

        return back()->with('swal.success', 'Kategori ' . $data['name'] . ' berhasil diperbarui');
    }

    public function destroy(IncomingLetterCategory $incomingLetterCategory)
    {
        gate('delete-incoming-letter-category');

        if ($incomingLetterCategory->incoming_letters->count() > 0) {
            return back()->with('swal.warning', 'Tidak dapat menghapus kategori, kategori masih terkait dengan data surat masuk.');
        }

        IncomingLetterCategory::destroy($incomingLetterCategory->id);

        Activity::dispatch('menghapus kategori surat masuk');

        return back()->with('swal.success', 'Kategori ' . $incomingLetterCategory->name . ' berhasil dihapus');
    }
}
