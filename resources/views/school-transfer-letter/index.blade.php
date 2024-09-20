@extends('layouts.base')

@section('content')
<h3 class="mb-4">Surat Keterangan Pindah Universitas</h3>
@if (can('create-school-transfer-letter'))
<div class="mb-3">
    <a href="{{ route('school-transfer-letter.create') }}" class="btn btn-sm btn-primary">Tambah Data</a>
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
                            <th>Nama Mahasiswa</th>
                            <th>Nomor Induk</th>
                            <th>Nomor Surat</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($schoolTransferLetters as $schoolTransferLetter)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $schoolTransferLetter->student->name }}</td>
                            <td>{{ $schoolTransferLetter->student->student_number }}</td>
                            <td>
                                @if ($schoolTransferLetter->letter->letter_number == null)
                                <span class="badge bg-light-danger">Tidak ada</span>
                                @else
                                {{ $schoolTransferLetter->letter->letter_number }}
                                @endif
                            </td>
                            <td>{{ $schoolTransferLetter->letter->created_at->isoFormat('DD MMMM Y') }}</td>
                            <td>
                                @if ($schoolTransferLetter->letter->verified())
                                <span class="badge bg-light-primary">Diverifikasi</span>
                                @elseif ($schoolTransferLetter->letter->rejected())
                                <span class="badge bg-light-danger">Ditolak</span>
                                @elseif ($schoolTransferLetter->letter->waiting())
                                <span class="badge bg-light-warning">Menunggu Verifikasi</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('school-transfer-letter.show', ['schoolTransferLetter' => $schoolTransferLetter]) }}" class="btn btn-sm btn-light-primary">Detail</a>
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