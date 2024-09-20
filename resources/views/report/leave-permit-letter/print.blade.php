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
<h3 style="text-align: center; text-decoration: underline; margin:1rem auto .3rem auto;">LAPORAN SURAT IZIN CUTI
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
            <th>Nama</th>
            <th>Jabatan</th>
            <th>Nomor Surat</th>
            <th>Tanggal</th>
            <th>Alasan Cuti</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($leavePermitLetters as $leavePermitLetter)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>
                {{ $leavePermitLetter->user->name }}
                @if ($nip = $leavePermitLetter->user->nip)
                <br>
                <small>NIP. {{ $nip }}</small>
                @endif
            </td>
            <td>
                @if ($position = $leavePermitLetter->user->position)
                {{ $position->name }}
                @else
                -
                @endif
            </td>
            <td>
                @if ($leavePermitLetter->letter->letter_number == null)
                <span class="badge bg-light-danger">Tidak ada</span>
                @else
                {{ $leavePermitLetter->letter->letter_number }}
                @endif
            </td>
            <td>{{ $leavePermitLetter->letter->created_at->isoFormat('DD MMMM Y') }}</td>
            <td>{{ $leavePermitLetter->reason }}</td>
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