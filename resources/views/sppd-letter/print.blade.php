@extends('layouts.print')
@section('style')
    <style>
        .content-table {
            width: 100%;
            margin-top: 2rem;
            border-collapse: collapse;
        }

        .content-table td {
            border: 1px solid black;
            padding: 10px;
        }

    </style>
@endsection
@section('content')
    <h3 style="text-align: center; text-decoration: underline; margin:1rem auto .3rem auto;">SURAT PERINTAH PERJALANAN DINAS
    </h3>
    <h4 style="text-align: center; margin:0;">NOMOR. {{ $sppdLetter->letter->letter_number }}</h4>
    <div style="margin: 4rem auto">
        <table class="content-table">
            <tbody>
                <tr>
                    <td style="width: 30px; text-align:center;">1</td>
                    <td>Pejabat yang memberi perintah</td>
                    <td>
                        {{ $sppdLetter->from->name }}
                        <br>
                        <small>{{ $sppdLetter->from->position ? $sppdLetter->from->position->name : '' }}</small>
                    </td>
                </tr>
                <tr>
                    <td style="width: 30px; text-align:center;">2</td>
                    <td>Nama pegawai yang diperintah</td>
                    <td>
                        <ol>
                            @foreach ($sppdLetter->recipients as $recipient)
                                <li>
                                    {{ $recipient->user->name }}
                                    @if ($nip = $recipient->user->nip)
                                        <br>
                                        <small>NIP. {{ $nip }}</small>
                                    @endif
                                </li>
                            @endforeach
                        </ol>
                    </td>
                </tr>
                <tr>
                    <td style="width: 30px; text-align:center;">3</td>
                    <td>Perjalanan dinas ke</td>
                    <td>{{ $sppdLetter->destination }}</td>
                </tr>
                <tr>
                    <td style="width: 30px; text-align:center;">4</td>
                    <td>Perjalanan dinas dari tanggal</td>
                    <td>{{ $sppdLetter->start_date->isoFormat('DD MMMM Y') }}</td>
                </tr>
                <tr>
                    <td style="width: 30px; text-align:center;">5</td>
                    <td>s.d tanggal</td>
                    <td>{{ $sppdLetter->end_date->isoFormat('DD MMMM Y') }}</td>
                </tr>
                <tr>
                    <td style="width: 30px; text-align:center;">6</td>
                    <td>Maksud/Tujuan mengadakan perjalanan</td>
                    <td>{{ $sppdLetter->purpose }}</td>
                </tr>
                <tr>
                    <td style="width: 30px; text-align:center;">7</td>
                    <td>Biaya perjalanan</td>
                    <td>@currency($sppdLetter->budget)</td>
                </tr>
            </tbody>
        </table>
    </div>
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
