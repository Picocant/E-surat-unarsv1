<?php

namespace App\Http\Controllers\My;

use App\Http\Controllers\Controller;
use App\Models\SppdLetter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SppdLetterController extends Controller
{
    public function index()
    {
        gate('read-received-sppd-letter');

        $user = User::with(['received_sppd_letters'])->find(Auth::id());

        $sppdLetters = $user->received_sppd_letters->map(function ($recipient) {
            return $recipient->sppd_letter;
        })->filter(function ($sppdLetter) {
            return $sppdLetter->letter->verified;
        });

        return view('my.sppd-letter.index', [
            'sppdLetters' => $sppdLetters
        ]);
    }

    public function print(SppdLetter $sppdLetter)
    {
        gate('read-received-sppd-letter');

        $user = User::find(Auth::id());

        config(['page.title' => 'Surat Izin Cuti']);

        if ($sppdLetter->letter->verified == false) {
            return back()->with('swal.warning', 'Tidak dapat mencetak surat yang belum diverifikasi');
        }

        if (!in_array($user, $sppdLetter->recipients)){
            return back()->with('swal.warning', 'Anda tidak berhak mencetak surat ini');
        }

        $signature = $sppdLetter->letter->signature;
        $decoded = json_decode($signature->payload, true);
        $url = url(route('signature.check', ['signature' => $signature]));

        return view('sppd-letter.print', [
            'sppdLetter' => $sppdLetter,
            'decoded' => $decoded,
            'url' => $url
        ]);
    }
}
