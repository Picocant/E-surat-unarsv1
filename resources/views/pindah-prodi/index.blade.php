@extends('layouts.base')

@section('content')
<h3 class="mb-4">Surat Keterangan Pindah Prodi</h3>
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
                        @foreach ($pindahprodis as $pindahprodi)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pindahprodi->student->name }}</td>
                            <td>{{ $pindahprodi->student->student_number }}</td>
                            <td>
                                @if ($pindahprodi->letter->letter_number == null)
                                <span class="badge bg-light-danger">Tidak ada</span>
                                @else
                                {{ $pindahprodi->letter->letter_number }}
                                @endif
                            </td>
                            <td>{{ $pindahprodi->letter->created_at->isoFormat('DD MMMM Y') }}</td>
                            <td>
                                @if ($pindahprodi->letter->verified())
                                <span class="badge bg-light-primary">Diverifikasi</span>
                                @elseif ($pindahprodi->letter->rejected())
                                <span class="badge bg-light-danger">Ditolak</span>
                                @elseif ($pindahprodi->letter->waiting())
                                <span class="badge bg-light-warning">Menunggu Verifikasi</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('pindah-prodi.show', ['pindahprodi' => $pindahprodi]) }}" class="btn btn-sm btn-light-primary">Detail</a>
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