<?php

namespace App\Http\Controllers;

use App\Events\Activity;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index()
    {
        gate('read-position');

        $positions = Position::with('users')->get();

        return view('position.index', [
            'positions' => $positions
        ]);
    }

    public function store(Request $request)
    {
        gate('create-position');

        $data = $request->validate([
            'name' => ['required', 'max:30'],
        ]);

        Position::create([
            'name' => $data['name'],
        ]);

        Activity::dispatch('membuat data jabatan');

        return back()->with('swal.success', 'Jabatan ' . $data['name'] . ' berhasil dibuat');
    }

    public function update(Request $request, Position $position)
    {
        gate('update-position');

        $data = $request->validate([
            'name' => ['required', 'max:30'],
        ]);

        $position->name = $data['name'];
        $position->save();

        Activity::dispatch('memperbarui data jabatan');

        return back()->with('swal.success', 'Jabatan ' . $data['name'] . ' berhasil diperbarui');
    }

    public function destroy(Position $position)
    {
        gate('delete-position');

        Position::destroy($position->id);
        User::where('position_id', $position->id)->update(['position_id' => null]);

        Activity::dispatch('menghapus data jabatan');

        return back()->with('swal.success', 'Jabatan ' . $position->name . ' berhasil dihapus');
    }
}
