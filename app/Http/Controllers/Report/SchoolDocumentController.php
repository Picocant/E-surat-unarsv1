<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\SchoolDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class SchoolDocumentController extends Controller
{
    public function index()
    {
        gate('generate-school-document-report');

        return view('report.school-document.index');
    }

    public function print(Request $request)
    {
        gate('generate-school-document-report');

        $filter = $request->validate([
            'filterFromDate' => ['nullable', 'date'],
            'filterToDate' => ['nullable', 'date', 'after_or_equal:filterFromDate'],
        ]);

        $data = SchoolDocument::select('*');

        if ($filter['filterFromDate']) {
            $data->where('created_at', '>=', $filter['filterFromDate']);
        }

        if ($filter['filterToDate']) {
            $data->where('created_at', '<=', $filter['filterToDate']);
        }

        $oldest = SchoolDocument::oldest('created_at')->first();

        $period = 'Semua Tanggal sejak ' . Carbon::createFromDate($oldest->created_at)->isoFormat('DD MMMM YYYY');
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
                "Jenis" => "Laporan Arsip Dokumen Sekolah",
                "Periode Laporan" => $period,
                "Ditandatangani Pada" => now()->isoFormat('dddd DD MMMM YYYY'),
            ]
        ]));

        return view('report.school-document.print', [
            'schoolDocuments' => $data->orderBy('created_at', 'ASC')->get(),
            'printBy' => auth()->user(),
            'printDate' => now()->isoFormat('DD MMMM YYYY'),
            'period' => $period,
            'signature' => $signature,
        ]);
    }
}
