@extends('layouts.print')

@section('style')
<style>
    .content-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 1rem;
    }

    .content-table td,
    .content-table th {
        border: 1px solid black;
        padding: 5px;
    }
</style>
@endsection

@section('content')
<h3 style="text-align: center; text-decoration: underline; margin:1rem auto .3rem auto;">LAPORAN SURAT PERINTAH
    PERJALANAN DINAS
</h3>
<table style="margin-top: 3.5rem;">
    <tr>
        <td>Dicetak oleh</td>
        <td>:</td>
        <td>{{ $printBy->name }}</td>
    </tr>
    <tr>
        <td>Dicetak Tanggal</td>
        <td>:</td>
        <td>{{ $printDate }}</td>
    </tr>
    <tr>
        <td>Periode Data</td>
        <td>:</td>
        <td>{{ $period }}</td>
    </tr>
</table>
<table class="content-table">
    <thead>
        <tr>
            <th>No</th>
            <th>Nomor Surat</th>
            <th>Pemberi Perintah</th>
            <th>Perjalanan Ke</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($sppdLetters as $sppdLetter)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>
                @if ($sppdLetter->letter->letter_number == null)
                <span class="badge bg-light-danger">Tidak ada</span>
                @else
                {{ $sppdLetter->letter->letter_number }}
                @endif
            </td>
            <td>{{ $sppdLetter->from->name }}</td>
            <td>{{ $sppdLetter->destination }}</td>
            <td>
                @if ($sppdLetter->letter->verified())
                <span class="badge bg-light-primary">Diverifikasi</span>
                @elseif ($sppdLetter->letter->rejected())
                <span class="badge bg-light-danger">Ditolak</span>
                @elseif ($sppdLetter->letter->waiting())
                <span class="badge bg-light-warning">Menunggu Verifikasi</span>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section('signature')
@php
$user = auth()->user();
$url = route('signature.by', ['user' => $user]) . '?token=' . $signature;
@endphp
<div style="margin-bottom: 12px;">Situbondo, {{ now()->isoFormat('DD MMMM Y') }}</div>
<div>Mengetahui,</div>
<div>{{ $user->position ? $user->position->name : '' }}</div>
<div style="margin:10px auto; display:flex; justify-content:center">
    <a href="{{ $url }}">
        {{ QrCode::size(100)->generate($url) }}
    </a>
</div>
<div style="font-weight: bold;">{{ $user->name }}</div>
<div>NIP. {{ $user->nip }}</div>
@endsection