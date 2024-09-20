@extends('layouts.print')

@section('content')
<h3 style="text-align: center; text-decoration: underline; margin:1rem auto .3rem auto;">SURAT KETERANGAN MAHASISWA AKTIF
    BELAJAR</h3>
<h4 style="text-align: center; margin:0;">NOMOR. {{ $activeStudentLetter->letter->letter_number }}</h4>
<div style="margin: 4rem auto">
    <p>Yang bertanda tangan di bawah ini {{ $decoded['signer']['position'] }}, dengan ini menerangkan bahwa:</p>
    <table style="width: 100%; margin:0 2rem;">
        <tr>
            <td>Nama</td>
            <td class="colons">:</td>
            <td>{{ $activeStudentLetter->student->name }}</td>
        </tr>
        <tr>
            <td>NIM</td>
            <td class="colons">:</td>
            <td>{{ $activeStudentLetter->student->student_number }}</td>
        </tr>
        <tr>
            <td>Tanggal Lahir</td>
            <td class="colons">:</td>
            <td>{{ $activeStudentLetter->student->date_of_bird->isoFormat('DD MMMM Y') }}</td>
        </tr>
        @if ($activeStudentLetter->student->guardian)
        <tr>
            <td>Nama Orang Tua/Wali</td>
            <td class="colons">:</td>
            <td>{{ $activeStudentLetter->student->guardian }}</td>
        </tr>
        @else
        <tr>
            <td>Nama Ayah</td>
            <td class="colons">:</td>
            <td>{{ $activeStudentLetter->student->father }}</td>
        </tr>
        <tr>
            <td>Nama Ibu</td>
            <td class="colons">:</td>
            <td>{{ $activeStudentLetter->student->mother }}</td>
        </tr>
        @endif
        <tr>
            <td>Alamat</td>
            <td class="colons">:</td>
            <td>{{ $activeStudentLetter->student->address }}</td>
        </tr>
    </table>
    <p>Benar nama yang tersebut di atas terdaftar sebagai mahasiswa di {{ config('app.name') }} dan masih
        aktif belajar sampai sekarang.</p>
    <p>Surat keterangan mahasiswa aktif ini dibuat sebagai <strong>{{ $activeStudentLetter->purpose }}</strong>.</p>
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