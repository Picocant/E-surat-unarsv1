@extends('layouts.print')

@section('content')
<h3 style="text-align: center; text-decoration: underline; margin:1rem auto .3rem auto;">SURAT IZIN CUTI</h3>
<div style="margin: 4rem auto">
    <table style="margin-bottom: 2rem">
        <tr>
            <td>Nomor</td>
            <td>:</td>
            <td>{{ $leavePermitLetter->letter->letter_number }}</td>
        </tr>
        <tr>
            <td>Perihal</td>
            <td>:</td>
            <td>{{ $leavePermitLetter->regarding }}</td>
        </tr>
        <tr>
            <td>Lampiran</td>
            <td>:</td>
            <td>{{ $leavePermitLetter->attachment }}</td>
        </tr>
    </table>
    <p>Yang bertanda tangan di bawah ini {{ $decoded['signer']['position'] }}, dengan ini menerangkan bahwa:</p>
    <table style="width: 100%; margin:0 2rem;">
        <tr>
            <td>Nama</td>
            <td class="colons">:</td>
            <td>{{ $leavePermitLetter->user->name }}</td>
        </tr>
        <tr>
            <td>NIP</td>
            <td class="colons">:</td>
            <td>{{ $leavePermitLetter->user->nip ? $leavePermitLetter->user->nip : '' }}</td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td class="colons">:</td>
            <td>{{ $leavePermitLetter->user->position ? $leavePermitLetter->user->position->name : '' }}</td>
        </tr>
        <tr>
            <td>Satuan Organisasi</td>
            <td class="colons">:</td>
            <td>{{ config('app.name') }}</td>
        </tr>
    </table>
    <p>Izin untuk cuti dan tidak dapat menjalankan tugas untuk sementara waktu selama
        <strong>{{ $leavePermitLetter->start_date->diffInDays($leavePermitLetter->end_date) + 1 }} hari</strong>
        terhitung sejak tanggal
        <strong>{{ $leavePermitLetter->start_date->isoFormat('DD MMMM Y') }}</strong> sampai dengan tanggal
        <strong>{{ $leavePermitLetter->end_date->isoFormat('DD MMMM Y') }}</strong> dengan alasan
        <strong>{{ $leavePermitLetter->reason }}</strong>.
    </p>
    <p>Demikian surat keterangan ini dibuat dengan sesungguhnya dan sebenar-benarnya untuk digunakan sebagai mana
        mestinya.</p>
</div>
@endsection

@section('signature')
<div style="margin-bottom: 12px;">Situbondo, {{ $decoded['signer']['signed_at'] }}</div>
<div>Mengetahui,</div>
<div>{{ $decoded['signer']['position'] }}</div>
<div style="margin:10px auto; display:flex; justify-content:center">
    <a href="{{ $url }}">
        {{ QrCode::size(100)->generate($url) }}
    </a>
</div>
<div style="font-weight: bold;">{{ $decoded['signer']['name'] }}</div>
<div>NIP. {{ $decoded['signer']['nip'] }}</div>
@endsection