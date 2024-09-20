@extends('layouts.base')

@section('style')
<style>
    .cs-bg-auth {
        background-image: linear-gradient(rgba(255, 255, 255, 0.8), rgba(255, 255, 255, 0.8)),
        url("{{ asset('img/GEDUNG.jpg') }}");
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
</style>
@endsection
@section('content')
<div class="cs-bg-auth py-lg-5 py-3 card shadow-sm">
    <div class="card-body">
        <div class="text-center text-dark">
            <img class="img-fluid mb-3" src="{{ asset('img/LOGO.png') }}" height="150" width="150" alt="">
            <h5 class="text-dark">Aplikasi Pengolahan Surat &amp; Pengarsipan Dokumen Universitas</h5>
            <h3 class="text-primary">{{ strtoupper(config('app.name')) }}</h3>
            <p>Alamat: Jl. Pb. Sudirman No.7, Karangasem, Patokan, Kec. Situbondo, Kabupaten Situbondo, Jawa Timur 68312</p>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <h4 class="text-center">Visi {{ config('app.name') }}</h4>
        <p class="text-center">Terwujudnya sekolah BAKTI (Berbudaya, Asri, Kreatif, Berteknologi dan Berimtaq) untuk
            menghasilkan Sumber Daya Manusia yang giat meraih prestasi serta berwawasan lingkungan</p>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <h4 class="text-center">Misi {{ config('app.name') }}</h4>
        <ol>
            <li>
                Membentuk peserta didik menjadi pribadi yang santun dalam bertindak serta disiplin, budaya bersih dan
                sehat dalam suasana penuh kekeluargaan.
            </li>
            <li>
                Menciptakan kondisi lingkungan sekolah yang asri dan berwawasan lingkungan hidup.
            </li>
            <li>
                Melaksanakan kegiatan pembelajaran yang kreatif, efektif, inovatif yang memungkinkan peserta didik giat
                meraih prestasi agar berkembang secara optimal sesuai dengan potensinya.
            </li>
            <li>
                Menjadikan lingkungan pendidikan yang lengkap sarana dan prasarananya sehingga mampu menghasilkan SDM
                yang memiliki ilmu pengetahuan dan teknologi agar terampil melestarikan lingkungan hidup, mencegah
                pencermaran dan merusak lingkungan.
            </li>
            <li>
                Melaksanakan pembiasaan diri untuk meningkatkan keimanan dan ketaqwaan terhadap Tuhan Yang Maha Esa.
            </li>
            <li>
                Meningkatkan profesionalisme dalam proses belajar mengajar.
            </li>
        </ol>
    </div>
</div>
@endsection