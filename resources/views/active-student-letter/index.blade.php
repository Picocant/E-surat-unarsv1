@extends('layouts.base')

@section('content')
<h3 class="mb-4">Surat Keterangan Mahasiswa Aktif</h3>
@if (can('create-active-student-letter'))
<div class="mb-3">
    <a href="{{ route('active-student-letter.create') }}" class="btn btn-sm btn-primary">Tambah Data</a>
</div>
@endif
<div class="card">
    <div class="card-content">
        <div class="card-body">
            <div class="table-responsive">
                <table class="tablelg" id="datatable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Mahasiswa</th>
                            <th>Nomor Induk</th>
                            <th>Nomor Surat</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($activeStudentLetters as $activeStudentLetter)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $activeStudentLetter->student->name }}</td>
                            <td>{{ $activeStudentLetter->student->student_number }}</td>
                            <td>
                                @if ($activeStudentLetter->letter->letter_number == null)
                                <span class="badge bg-light-danger">Tidak ada</span>
                                @else
                                {{ $activeStudentLetter->letter->letter_number }}
                                @endif
                            </td>
                            <td>{{ $activeStudentLetter->letter->created_at->isoFormat('DD MMMM Y') }}</td>
                            <td>
                                @if ($activeStudentLetter->letter->verified())
                                <span class="badge bg-light-primary">Diverifikasi</span>
                                @elseif ($activeStudentLetter->letter->rejected())
                                <span class="badge bg-light-danger">Ditolak</span>
                                @elseif ($activeStudentLetter->letter->waiting())
                                <span class="badge bg-light-warning">Menunggu Verifikasi</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('active-student-letter.show', ['activeStudentLetter' => $activeStudentLetter]) }}" class="btn btn-sm btn-light-primary">Detail</a>
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