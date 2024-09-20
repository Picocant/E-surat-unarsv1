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
<h3 style="text-align: center; text-decoration: underline; margin:1rem auto .3rem auto;">LAPORAN DISPOSISI SURAT MASUK
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
            <th>Tanggal Disposisi</th>
            <th>Nomor Surat</th>
            <th>Tanggal Surat</th>
            <th>Asal Surat</th>
            <th>Perihal</th>
            <th>Tujuan Disposisi</th>
            <th>Sifat</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($incomingLetterDispositions as $incomingLetterDisposition)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $incomingLetterDisposition->created_at->isoFormat('DD MMMM Y') }}</td>
            <td>{{ $incomingLetterDisposition->incoming_letter->letter_number }}</td>
            <td>{{ $incomingLetterDisposition->incoming_letter->date->isoFormat('DD MMMM Y') }}
            </td>
            <td>{{ $incomingLetterDisposition->incoming_letter->from }}</td>
            <td>{{ $incomingLetterDisposition->incoming_letter->regarding }}</td>
            <td>{{ $incomingLetterDisposition->to }}</td>
            <td>{{ $incomingLetterDisposition->type }}</td>
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