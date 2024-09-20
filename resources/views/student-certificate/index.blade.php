@extends('layouts.base')

@section('content')
<h3 class="mb-4">Arsip Ijazah Mahasiswa</h3>
@if (can('create-student-certificate'))
<div class="mb-3">
    <a href="{{ route('student-certificate.create') }}" class="btn btn-sm btn-primary">Tambah Data</a>
</div>
@endif
<div class="card">
    <div class="card-content">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="datatable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomor Arsip</th>
                            <th>Nomor Ijazah</th>
                            <th>Nomor Induk</th>
                            <th>Nama Mahasiswa</th>
                            <th>Tahun Ajaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($studentCertificates as $studentCertificate)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><code>{{ $studentCertificate->archive->number }}</code></td>
                            <td>{{ $studentCertificate->number }}</td>
                            <td>{{ $studentCertificate->student->student_number }}</td>
                            <td>{{ $studentCertificate->student->name }}</td>
                            <td>{{ $studentCertificate->academic_year }}</td>
                            <td>
                                <a href="{{ route('student-certificate.show', ['studentCertificate' => $studentCertificate]) }}" class="btn btn-sm btn-light-primary">Detail</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection