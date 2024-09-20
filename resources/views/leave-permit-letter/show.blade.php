@extends('layouts.base')

@section('content')
<div class="row">
    <div class="col-lg-6 mx-auto">
        <h3 class="mb-4">Surat Izin Cuti</h3>
        <div class="mb-3">
            <a href="{{ route('leave-permit-letter.index') }}" class="btn btn-sm btn-primary">Kembali</a>
            @if ($leavePermitLetter->letter->verified())
            <a target="_blank" href="{{ route('leave-permit-letter.print', ['leavePermitLetter' => $leavePermitLetter]) }}" class="btn btn-sm btn-primary">Cetak</a>
            @else
            @if ($leavePermitLetter->letter->waiting())
            @if (can('update-leave-permit-letter'))
            <a href="{{ route('leave-permit-letter.edit', ['leavePermitLetter' => $leavePermitLetter]) }}" class="btn btn-sm btn-primary">Edit</a>
            @endif
            @if (can('update-leave-permit-letter-verification'))
            <button type="button" data-bs-toggle="modal" data-bs-target="#verify-modal" class="btn btn-sm btn-primary">Verifikasi</button>
            <button type="button" data-bs-toggle="modal" data-bs-target="#reject-modal" class="btn btn-sm btn-primary">Tolak</button>
            @endif
            @endif
            @endif
            @if (!$leavePermitLetter->letter->verified)
            @else
            @endif
            @if (can('delete-leave-permit-letter'))
            <form class="d-inline" action="{{ route('leave-permit-letter.destroy', ['leavePermitLetter' => $leavePermitLetter]) }}" method="post">
                @csrf
                @method('delete')
                <button onclick="return confirm('Hapus surat?')" type="submit" class="btn btn-sm btn-danger">Hapus</button>
            </form>
            @endif
        </div>
        <div>
            @if ($leavePermitLetter->letter->verified())
            <div role="alert" class="alert alert-light-success">
                <h6 class="fw-bold">Status: {{ $leavePermitLetter->letter->status }}</h6>
                <p>{{ $leavePermitLetter->letter->note }}</p>
            </div>
            @elseif ($leavePermitLetter->letter->rejected())
            <div role="alert" class="alert alert-light-danger">
                <h6 class="fw-bold">Status: {{ $leavePermitLetter->letter->status }}</h6>
                <p>{{ $leavePermitLetter->letter->note }}</p>
            </div>
            @elseif ($leavePermitLetter->letter->waiting())
            <div role="alert" class="alert alert-light-warning">
                <h6 class="fw-bold">Status: {{ $leavePermitLetter->letter->status }}</h6>
                <p>{{ $leavePermitLetter->letter->note }}</p>
            </div>
            @endif
        </div>
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td>Tanggal Surat</td>
                            <td>:</td>
                            <td>{{ $leavePermitLetter->letter->created_at->isoFormat('DD MMMM Y') }}</td>
                        </tr>
                        <tr>
                            <td>Perihal</td>
                            <td>:</td>
                            <td>{{ $leavePermitLetter->regarding }}</td>
                        </tr>
                        <tr>
                            <td>Lampiran</td>
                            <td>:</td>
                            <td>{{ $leavePermitLetter->attachment }}</td>
                        </tr>
                        <tr>
                            <td>Nomor Surat</td>
                            <td>:</td>
                            <td>
                                @if ($leavePermitLetter->letter->letter_number == null)
                                <span class="badge bg-light-danger">Tidak ada</span>
                                @else
                                {{ $leavePermitLetter->letter->letter_number }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Nama Pegawai Universitas</td>
                            <td>:</td>
                            <td>{{ $leavePermitLetter->user->name }}</td>
                        </tr>
                        <tr>
                            <td>NIP</td>
                            <td>:</td>
                            <td>{{ $leavePermitLetter->user->nip }}</td>
                        </tr>
                        <tr>
                            <td>Jabatan</td>
                            <td>:</td>
                            <td>
                                {{ $leavePermitLetter->user->position ? $leavePermitLetter->user->position->name : '-' }}
                            </td>
                        </tr>
                        <tr>
                            <td>Tanggal Mulai Cuti</td>
                            <td>:</td>
                            <td>{{ $leavePermitLetter->start_date->isoFormat('DD MMMM Y') }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Selesai Cuti</td>
                            <td>:</td>
                            <td>{{ $leavePermitLetter->end_date->isoFormat('DD MMMM Y') }}</td>
                        </tr>
                        <tr>
                            <td>Alasan Cuti</td>
                            <td>:</td>
                            <td>{{ $leavePermitLetter->reason }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<x-modal modal-id="verify-modal" modal-title="Verifikasi surat" modal-size="">
    <form action="{{ route('leave-permit-letter.verify', ['leavePermitLetter' => $leavePermitLetter]) }}" method="POST">
        @csrf
        @method('put')
        <div class="form-group">
            <label class="form-label" for="note">Catatan Verifikasi</label>
            <textarea class="form-control" name="note" id="note" rows="3"></textarea>
        </div>
        <button onclick="return confirm('Verifikasi surat ini?')" type="submit" class="btn btn-sm btn-primary">Verifikasi</button>
    </form>
</x-modal>
<x-modal modal-id="reject-modal" modal-title="Tolak surat" modal-size="">
    <form action="{{ route('leave-permit-letter.reject', ['leavePermitLetter' => $leavePermitLetter]) }}" method="POST">
        @csrf
        @method('put')
        <div class="form-group">
            <label class="form-label" for="note">Catatan Penolakan</label>
            <textarea class="form-control" name="note" id="note" rows="3"></textarea>
        </div>
        <button onclick="return confirm('Tolak surat ini?')" type="submit" class="btn btn-sm btn-primary">Tolak</button>
    </form>
</x-modal>
@endsection