@extends('layouts.print')

@section('content')
<h3 style="text-align: center; text-decoration: underline; margin:1rem auto .3rem auto;">SURAT KETERANGAN PINDAH PRODI
</h3>
<h4 style="text-align: center; margin:0;">NOMOR. {{ $pindahprodi->letter->letter_number }}</h4>
<div style="margin: 4rem auto">
    <p>Yang bertanda tangan di bawah ini {{ $decoded['signer']['position'] }}, dengan ini menerangkan bahwa:</p>
    <table style="width: 100%; margin:0 2rem;">
        <tr>
            <td>Nama</td>
            <td class="colons">:</td>
            <td>{{ $pindahprodi->student->name }}</td>
        </tr>
        <tr>
            <td>NIM</td>
            <td class="colons">:</td>
            <td>{{ $pindahprodi->student->student_number }}</td>
        </tr>
        <tr>
            <td>Tanggal Lahir</td>
            <td class="colons">:</td>
            <td>{{ $pindahprodi->student->date_of_bird->isoFormat('DD MMMM Y') }}</td>
        </tr>
        @if ($pindahprodi->student->guardian)
        <tr>
            <td>Nama Orang Tua/Wali</td>
            <td class="colons">:</td>
            <td>{{ $pindahprodi->student->guardian }}</td>
        </tr>
        @else
        <tr>
            <td>Nama Ayah</td>
            <td class="colons">:</td>
            <td>{{ $pindahprodi->student->father }}</td>
        </tr>
        <tr>
            <td>Nama Ibu</td>
            <td class="colons">:</td>
            <td>{{ $pindahprodi->student->mother }}</td>
        </tr>
        @endif
        <tr>
            <td>Alamat</td>
            <td class="colons">:</td>
            <td>{{ $pindahprodi->student->address }}</td>
        </tr>
    </table>
    <p>Sesuai permohonan yang telah diajukan oleh orang tua/wali mahasiswa, telah mengajukan pindah universitas dari
        <strong>{{ config('app.name') }}</strong> ke <strong>{{ $pindahprodi->new_prodi }}</strong>
        dengan alasan <strong>{{ $pindahprodi->reason }}</strong>.
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