<?php

namespace App\Http\Controllers;

use App\Models\ActiveStudentLetter;
use App\Models\IncomingLetter;
use App\Models\IncomingLetterDisposition;
use App\Models\LeavePermitLetter;
use App\Models\Letter;
use App\Models\SchoolDocument;
use App\Models\SchoolTransferLetter;
use App\Models\SppdLetter;
use App\Models\Student;
use App\Models\StudentCertificate;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('home.index', [
            'incomingLetterCount' => IncomingLetter::count(),
            'incomingLetterDispositionCount' => IncomingLetterDisposition::count(),
            'activeStudentLetterCount' => ActiveStudentLetter::count(),
            'schoolTransferLetterCount' => SchoolTransferLetter::count(),
            'sppdLetterCount' => SppdLetter::count(),
            'leavePermitLetterCount' => LeavePermitLetter::count(),
            'schoolDocumentCount' => SchoolDocument::count(),
            'studentCertificateCount' => StudentCertificate::count(),
            'userLeavePermitLetterCount' => $user->leave_permit_letters->count(),
            'userReceivedSPPDCount' => $user->received_sppd_letters->count()
        ]);
    }

    public function chart()
    {
        $letters = Letter::all();
        $verifiedLetter = $letters->filter(function ($letter) {
            return $letter->verified == true;
        })->count();
        $unverifiedLetter = $letters->filter(function ($letter) {
            return $letter->verified == false;
        })->count();

        $a = Carbon::now()->subMonth(5);
        $b = Carbon::now()->subMonth(4);
        $c = Carbon::now()->subMonth(3);
        $d = Carbon::now()->subMonth(2);
        $e = Carbon::now()->subMonth(1);
        $f = Carbon::now();
        $categories = [
            $a->isoFormat('MMMM YYYY'),
            $b->isoFormat('MMMM YYYY'),
            $c->isoFormat('MMMM YYYY'),
            $d->isoFormat('MMMM YYYY'),
            $e->isoFormat('MMMM YYYY'),
            $f->isoFormat('MMMM YYYY'),
        ];
        $data = [
            IncomingLetter::whereMonth('date', $a->month)->count(),
            IncomingLetter::whereMonth('date', $b->month)->count(),
            IncomingLetter::whereMonth('date', $c->month)->count(),
            IncomingLetter::whereMonth('date', $d->month)->count(),
            IncomingLetter::whereMonth('date', $e->month)->count(),
            IncomingLetter::whereMonth('date', $f->month)->count(),
        ];
        return response()->json([
            'letterVerification' => [
                'chart' => [
                    'type' => 'pie'
                ],
                'series' => [$verifiedLetter, $unverifiedLetter],
                'labels' => ['Diverifikasi', 'Belum Diverifikasi']
            ],
            'incomingLetter' => [
                'series' => [
                    [
                        'name' => 'Surat Masuk',
                        'data' => $data,
                    ],
                ],
                'chart' => [
                    'type' => 'bar',
                    'height' => 350,
                ],
                'dataLabels' => [
                    'enabled' => false,
                ],
                'legend' => [
                    'show' => false,
                ],
                'xaxis' => [
                    'categories' => $categories,
                ],
                'yaxis' => [
                    'title' => [
                        'text' => 'Jumlah Surat Masuk',
                    ],
                ],
            ],
        ]);
    }
}
