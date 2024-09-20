@extends('layouts.base')

@section('content')
    <h3 class="mb-4">Surat Izin Cuti</h3>
    @if (can('create-leave-permit-letter'))
        <div class="mb-3">
            <a href="{{ route('leave-permit-letter.create') }}" class="btn btn-sm btn-primary">Tambah Data</a>
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
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Nomor Surat</th>
                                <th>Tanggal</th>
                                <th>Alasan Cuti</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($leavePermitLetters as $leavePermitLetter)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $leavePermitLetter->user->name }}
                                        @if ($nip = $leavePermitLetter->user->nip)
                                            <br>
                                            <small>NIP. {{ $nip }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($position = $leavePermitLetter->user->position)
                                            {{ $position->name }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if ($leavePermitLetter->letter->letter_number == null)
                                            <span class="badge bg-light-danger">Tidak ada</span>
                                        @else
                                            {{ $leavePermitLetter->letter->letter_number }}
                                        @endif
                                    </td>
                                    <td>{{ $leavePermitLetter->letter->created_at->isoFormat('DD MMMM Y') }}</td>
                                    <td>{{ $leavePermitLetter->reason }}</td>
                                    <td>
                                        @if ($leavePermitLetter->letter->verified())
                                            <span class="badge bg-light-primary">Diverifikasi</span>
                                        @elseif ($leavePermitLetter->letter->rejected())
                                            <span class="badge bg-light-danger">Ditolak</span>
                                        @elseif ($leavePermitLetter->letter->waiting())
                                            <span class="badge bg-light-warning">Menunggu Verifikasi</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('leave-permit-letter.show', ['leavePermitLetter' => $leavePermitLetter]) }}"
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
