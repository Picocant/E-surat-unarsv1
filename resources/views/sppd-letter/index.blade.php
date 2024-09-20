@extends('layouts.base')

@section('content')
    <h3 class="mb-4">Surat Perintah Perjalanan Dinas</h3>
    @if (can('create-sppd-letter'))
        <div class="mb-3">
            <a href="{{ route('sppd-letter.create') }}" class="btn btn-sm btn-primary">Tambah Data</a>
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
                                <th>Nomor Surat</th>
                                <th>Pemberi Perintah</th>
                                <th>Perjalanan Ke</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sppdLetters as $sppdLetter)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if ($sppdLetter->letter->letter_number == null)
                                            <span class="badge bg-light-danger">Tidak ada</span>
                                        @else
                                            {{ $sppdLetter->letter->letter_number }}
                                        @endif
                                    </td>
                                    <td>{{ $sppdLetter->from->name }}</td>
                                    <td>{{ $sppdLetter->destination }}</td>
                                    <td>
                                        @if ($sppdLetter->letter->verified())
                                            <span class="badge bg-light-primary">Diverifikasi</span>
                                        @elseif ($sppdLetter->letter->rejected())
                                            <span class="badge bg-light-danger">Ditolak</span>
                                        @elseif ($sppdLetter->letter->waiting())
                                            <span class="badge bg-light-warning">Menunggu Verifikasi</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('sppd-letter.show', ['sppdLetter' => $sppdLetter]) }}"
                                            class="btn btn-sm btn-light-primary">Detail</a>
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
