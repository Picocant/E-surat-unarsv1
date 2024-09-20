<?php

namespace App\Http\Controllers\My;

use App\Http\Controllers\Controller;
use App\Models\LeavePermitLetter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeavePermitLetterController extends Controller
{
    public function index()
    {
        gate('request-leave-permit-letter');

        $user = User::with('leave_permit_letters')->find(Auth::id());

        return view('my.leave-permit-letter.index', [
            'leavePermitLetters' => $user->leave_permit_letters
        ]);
    }

    public function print(LeavePermitLetter $leavePermitLetter)
    {
        gate('request-leave-permit-letter');

        config(['page.title' => 'Surat Izin Cuti']);
        $user = User::find(Auth::id());

        if ($leavePermitLetter->letter->verified == false) {
            return back()->with('swal.warning', 'Tidak dapat mencetak surat yang belum diverifikasi');
        }

        if($leavePermitLetter->user_id !== $user->id) {
            return back()->with('swal.warning', 'Anda tidak berhak mencetak surat ini');
        }

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
