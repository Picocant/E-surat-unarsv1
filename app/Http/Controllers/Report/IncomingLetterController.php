<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\IncomingLetter;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class IncomingLetterController extends Controller
{
    public function index()
    {
        gate('generate-incoming-letter-report');

        return view('report.incoming-letter.index');
    }

    public function print(Request $request)
    {
        gate('generate-incoming-letter-report');

        $filter = $request->validate([
            'filterFromDate' => ['nullable', 'date'],
            'filterToDate' => ['nullable', 'date', 'after_or_equal:filterFromDate'],
        ]);

        $data = IncomingLetter::select('*');

        if ($filter['filterFromDate']) {
            $data->where('date', '>=', $filter['filterFromDate']);
        }

        if ($filter['filterToDate']) {
            $data->where('date', '<=', $filter['filterToDate']);
        }

        $oldest = IncomingLetter::oldest('date')->first();

        $period = 'Semua Tanggal sejak ' . Carbon::createFromDate($oldest->date)->isoFormat('DD MMMM YYYY');
        if ($filter['filterFromDate'] && $filter['filterToDate']) {
            if ($filter['filterFromDate'] == $filter['filterToDate']) {
                $period = Carbon::createFromDate($filter['filterFromDate'])->isoFormat('DD MMMM YYYY');
            } else {
                $period = Carbon::createFromDate($filter['filterFromDate'])->isoFormat('DD MMMM YYYY') . ' s.d ' . Carbon::createFromDate($filter['filterToDate'])->isoFormat('DD MMMM YYYY');
            }
        } else if ($filter['filterFromDate'] && $filter['filterToDate'] == null) {
            $period = Carbon::createFromDate($filter['filterFromDate'])->isoFormat('DD MMMM YYYY') . ' s.d Sekarang';
        } else if ($filter['filterFromDate'] == null && $filter['filterToDate']) {
            $period = 'Semua Tanggal s.d ' . Carbon::createFromDate($filter['filterToDate'])->isoFormat('DD MMMM YYYY');
        }

        $signature = base64_encode(json_encode([
            "uid" => auth()->id(),
            "details" => [
                "Jenis" => "Laporan Surat Masuk",
                "Periode Laporan" => $period,
                "Ditandatangani Pada" => now()->isoFormat('dddd DD MMMM YYYY'),
            ]
        ]));

        return view('report.incoming-letter.print', [
            'incomingLetters' => $data->orderBy('date', 'ASC')->get(),
            'printBy' => auth()->user(),
            'printDate' => now()->isoFormat('DD MMMM YYYY'),
            'period' => $period,
            'signature' => $signature
        ]);
    }
}
