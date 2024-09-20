@extends('layouts.base')

@section('content')
<h3 class="mb-4">Detail Arsip Ijazah Mahasiswa</h3>
<div class="mb-3">
    <a href="{{ route('student-certificate.index') }}" class="btn btn-sm btn-primary">Kembali</a>
    @if (can('update-student-certificate'))
    <a href="{{ route('student-certificate.edit', ['studentCertificate' => $studentCertificate]) }}" class="btn btn-sm btn-primary">Edit</a>
    @endif
    @if (can('delete-student-certificate'))
    <form action="{{ route('student-certificate.destroy', ['studentCertificate' => $studentCertificate]) }}" class="d-inline" method="POST">
        @csrf
        @method('delete')
        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus ijazah Mahasiswa?')">Hapus</button>
    </form>
    @endif
</div>
<div class="row">
    <div class="col-lg-4">
        <h5 class="mb-3">Keterangan</h5>
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td>Nomor Arsip</td>
                            <td>:</td>
                            <td><code>{{ $studentCertificate->archive->number }}</code></td>
                        </tr>
                        <tr>
                            <td>Nama Siswa</td>
                            <td>:</td>
                            <td>{{ $studentCertificate->student->name }}</td>
                        </tr>
                        <tr>
                            <td>Nomor Induk</td>
                            <td>:</td>
                            <td>{{ $studentCertificate->student->student_number }}</td>
                        </tr>
                        <tr>
                            <td>Nomor Ijazah</td>
                            <td>:</td>
                            <td>{{ $studentCertificate->number }}</td>
                        </tr>
                        <tr>
                            <td>Tahun Ajaran</td>
                            <td>:</td>
                            <td>{{ $studentCertificate->academic_year }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <h5 class="mb-3">File Preview</h5>
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <object border="0" data="{{ asset('storage/' . $studentCertificate->file) }}#toolbar=0" type="application/pdf" width="100%" height="600px">
                        <p class="text-muted">Browser anda tidak mendukung untuk melihat file pdf.
                            Klik <a href="{{ asset('storage/' . $studentCertificate->file) }}">di sini</a>
                            untuk mendownload file arsip.</p>
                    </object>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection