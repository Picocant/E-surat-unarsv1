@extends('layouts.base')

@section('content')
<div style="background: linear-gradient(0deg, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url({{ asset('img/GEDUNG.jpg') }}); background-size:cover; background-position:bottom;" class="py-lg-5 py-3 card shadow-sm">
    <div class="card-body">
        <div class="text-center text-light">
            <img class="img-fluid mb-3" src="{{ asset('img/LOGO.png') }}" height="150" width="150" alt="">
            <h5 class="text-light">Aplikasi Pengolahan Surat &amp; Pengarsipan Dokumen Universitas</h5>
            <h3 class="text-light">{{ strtoupper(config('app.name')) }}</h3>
            <p>Alamat: Jl. Pb. Sudirman No.7, Karangasem, Patokan, Kec. Situbondo, Kabupaten Situbondo, Jawa Timur 68312</p>
        </div>
    </div>
</div>
<div class="row">
    @if (can('request-leave-permit-letter'))
    <div class="col-6 col-lg-6 col-md-6">
        <div class="card" role="button" onclick="window.location.href='{{ route('my.leave-permit-letter.index') }}'">
            <div class="card-body px-3 py-4-5">
                <div class="row">
                    <div class="col-md-3">
                        <div class="stats-icon green">
                            <i class="fas fa-envelope"></i>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <h6 class="text-muted font-semibold">Pengajuan Izin Cuti Saya</h6>
                        <h6 class="font-extrabold mb-0">{{ $userLeavePermitLetterCount }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if (can('read-received-sppd-letter'))
    <div class="col-6 col-lg-6 col-md-6">
        <div class="card" role="button" onclick="window.location.href='{{ route('my.sppd-letter.index') }}'">
            <div class="card-body px-3 py-4-5">
                <div class="row">
                    <div class="col-md-3">
                        <div class="stats-icon blue">
                            <i class="fas fa-envelope"></i>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <h6 class="text-muted font-semibold">Surat Perjalanan Dinas Saya</h6>
                        <h6 class="font-extrabold mb-0">{{ $userReceivedSPPDCount }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
<div class="row">
    @if (can('read-incoming-letter'))
    <div class="col-6 col-lg-3 col-md-6">
        <div class="card" role="button" onclick="window.location.href='{{ route('incoming-letter.index') }}'">
            <div class="card-body px-3 py-4-5">
                <div class="row">
                    <div class="col-md-3">
                        <div class="stats-icon purple">
                            <i class="fas fa-envelope"></i>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <h6 class="text-muted font-semibold">Surat Masuk</h6>
                        <h6 class="font-extrabold mb-0">{{ $incomingLetterCount }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if (can('read-incoming-letter-disposition'))
    <div class="col-6 col-lg-3 col-md-6">
        <div class="card" role="button" onclick="window.location.href='{{ route('incoming-letter-disposition.index') }}'">
            <div class="card-body px-3 py-4-5">
                <div class="row">
                    <div class="col-md-3">
                        <div class="stats-icon blue">
                            <i class="fas fa-envelope-circle-check"></i>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <h6 class="text-muted font-semibold">Disposisi</h6>
                        <h6 class="font-extrabold mb-0">{{ $incomingLetterDispositionCount }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if (can('read-active-student-letter'))
    <div class="col-6 col-lg-3 col-md-6">
        <div class="card" role="button" onclick="window.location.href='{{ route('active-student-letter.index') }}'">
            <div class="card-body px-3 py-4-5">
                <div class="row">
                    <div class="col-md-3">
                        <div class="stats-icon green">
                            <i class="fas fa-envelope"></i>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <h6 class="text-muted font-semibold">Surat Mahasiswa Aktif</h6>
                        <h6 class="font-extrabold mb-0">{{ $activeStudentLetterCount }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if (can('read-school-transfer-letter'))
    <div class="col-6 col-lg-3 col-md-6">
        <div class="card" role="button" onclick="window.location.href='{{ route('school-transfer-letter.index') }}'">
            <div class="card-body px-3 py-4-5">
                <div class="row">
                    <div class="col-md-3">
                        <div class="stats-icon red">
                            <i class="fas fa-envelope"></i>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <h6 class="text-muted font-semibold">Surat Pindah Universitas</h6>
                        <h6 class="font-extrabold mb-0">{{ $schoolTransferLetterCount }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if (can('read-sppd-letter'))
    <div class="col-6 col-lg-3 col-md-6">
        <div class="card" role="button" onclick="window.location.href='{{ route('sppd-letter.index') }}'">
            <div class="card-body px-3 py-4-5">
                <div class="row">
                    <div class="col-md-3">
                        <div class="stats-icon red">
                            <i class="fas fa-envelope"></i>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <h6 class="text-muted font-semibold">Surat Perjalanan Dinas</h6>
                        <h6 class="font-extrabold mb-0">{{ $sppdLetterCount }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if (can('read-leave-permit-letter'))
    <div class="col-6 col-lg-3 col-md-6">
        <div class="card" role="button" onclick="window.location.href='{{ route('leave-permit-letter.index') }}'">
            <div class="card-body px-3 py-4-5">
                <div class="row">
                    <div class="col-md-3">
                        <div class="stats-icon green">
                            <i class="fas fa-envelope"></i>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <h6 class="text-muted font-semibold">Surat Izin Cuti</h6>
                        <h6 class="font-extrabold mb-0">{{ $leavePermitLetterCount }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if (can('read-school-document'))
    <div class="col-6 col-lg-3 col-md-6">
        <div class="card" role="button" onclick="window.location.href='{{ route('school-document.index') }}'">
            <div class="card-body px-3 py-4-5">
                <div class="row">
                    <div class="col-md-3">
                        <div class="stats-icon blue">
                            <i class="fas fa-file-zipper"></i>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <h6 class="text-muted font-semibold">Dokumen Universitas</h6>
                        <h6 class="font-extrabold mb-0">{{ $schoolDocumentCount }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if (can('read-student-certificate'))
    <div class="col-6 col-lg-3 col-md-6">
        <div class="card" role="button" onclick="window.location.href='{{ route('student-certificate.index') }}'">
            <div class="card-body px-3 py-4-5">
                <div class="row">
                    <div class="col-md-3">
                        <div class="stats-icon purple">
                            <i class="fas fa-file"></i>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <h6 class="text-muted font-semibold">Ijazah Mahasiswa</h6>
                        <h6 class="font-extrabold mb-0">{{ $studentCertificateCount }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
<div class="row">
    @if (can('read-incoming-letter'))
    <div class="col-lg-7">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <h5 class="mb-3">Surat Masuk</h5>
                    <div id="incoming-letter"></div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if (canAll([
    'read-active-student-letter',
    'read-school-transfer-letter',
    'read-sppd-letter',
    'read-leave-permit-letter',
    ]))
    <div class="col-lg-5">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <h5 class="mb-3">Status Verifikasi Surat</h5>
                    <div id="letter-verification"></div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
@section('script')
<script>
    fetch('/home/chart')
        .then(response => response.json())
        .then(charts => {
            let letterVerification = document.querySelector("#letter-verification")
            let letterVerificationChart = new ApexCharts(letterVerification, charts.letterVerification)
            letterVerificationChart.render()

            let incomingLetter = document.querySelector("#incoming-letter")
            let incomingLetterChartConfig = charts.incomingLetter
            incomingLetterChartConfig.yaxis['labels'] = {
                formatter: (value) => value.toFixed(0)
            }
            let incomingLetterChart = new ApexCharts(incomingLetter, incomingLetterChartConfig)
            incomingLetterChart.render()
        })
</script>
@endsection