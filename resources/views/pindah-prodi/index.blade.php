@extends('layouts.base')

@section('content')
<h3 class="mb-4">Surat Keterangan Pindah Universitas</h3>
@if (can('create-pindah-prodi'))
<div class="mb-3">
    <a href="{{ route('pindah-prodi.create') }}" class="btn btn-sm btn-primary">Tambah Data</a>
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
                        @foreach ($pindahProdi as $pindahProdi)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pindahProdi->student->name }}</td>
                            <td>{{ $pindahProdi->student->student_number }}</td>
                            <td>
                                @if ($pindahProdi->letter->letter_number == null)
                                <span class="badge bg-light-danger">Tidak ada</span>
                                @else
                                {{ $pindahProdi->letter->letter_number }}
                                @endif
                            </td>
                            <td>{{ $pindahProdi->letter->created_at->isoFormat('DD MMMM Y') }}</td>
                            <td>
                                @if ($pindahProdi->letter->verified())
                                <span class="badge bg-light-primary">Diverifikasi</span>
                                @elseif ($pindahProdi->letter->rejected())
                                <span class="badge bg-light-danger">Ditolak</span>
                                @elseif ($pindahProdi->letter->waiting())
                                <span class="badge bg-light-warning">Menunggu Verifikasi</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('pindah-prodi.show', ['pindahProdi' => $pindahProdi]) }}" class="btn btn-sm btn-light-primary">Detail</a>
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