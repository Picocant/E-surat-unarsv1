<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        gate('manage-system');

        $activities = Activity::orderBy('created_at', 'DESC')->paginate(30);

        return view('activity.index', [
            'activities' => $activities
        ]);
    }

    public function clear()
    {
        gate('manage-system');
        
        Activity::truncate();
        return to_route('system.activities')->with('swal.success', 'Log aktivitas berhasil dihapus.');
    }
}
