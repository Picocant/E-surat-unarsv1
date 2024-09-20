@extends('layouts.print')

@section('style')
    <style>
        .content-table {
            width: 100%;
            margin-top: 4rem;
            border-collapse: collapse;
        }

        .content-table td {
            border: 1px solid black;
            padding: 10px;
        }

    </style>
@endsection

@section('content')
    <h3 style="text-align: center; text-decoration: underline; margin:1rem auto .3rem auto;">LEMBAR DISPOSISI</h3>
    <table class="content-table">
        <tr>
            <td>Tanggal Disposisi</td>
            <td>{{ $incomingLetterDisposition->created_at->isoFormat('DD MMMM Y') }}</td>
        </tr>
        <tr>
            <td>Tujuan Disposisi</td>
            <td>{{ $incomingLetterDisposition->to }}</td>
        </tr>
        <tr>
            <td>Nomor Surat</td>
            <td>{{ $incomingLetterDisposition->incoming_letter->letter_number }}</td>
        </tr>
        <tr>
            <td>Tanggal Surat</td>
            <td>{{ $incomingLetterDisposition->incoming_letter->date->isoFormat('DD MMMM Y') }}</td>
        </tr>
        <tr>
            <td>Asal Surat</td>
            <td>{{ $incomingLetterDisposition->incoming_letter->from }}</td>
        </tr>
        <tr>
            <td>Perihal</td>
            <td>{{ $incomingLetterDisposition->incoming_letter->regarding }}</td>
        </tr>
        <tr>
            <td>Sifat Disposisi</td>
            <td>{{ $incomingLetterDisposition->type }}</td>
        </tr>
        <tr>
            <td colspan="2">
                Isi Disposisi:
                <br>
                {{ $incomingLetterDisposition->message }}
            </td>
        </tr>
    </table>
@endsection

@section('signature')
    <div style="margin-bottom: 12px;">Barito Kuala, {{ $decoded['signer']['signed_at'] }}</div>
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
