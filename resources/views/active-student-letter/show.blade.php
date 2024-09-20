@extends('layouts.base')

@section('content')
<div class="row">
    <div class="col-lg-6 mx-auto">
        <h3 class="mb-4">Surat Keterangan Mahasiswa Aktif</h3>
        <div class="mb-3">
            <a href="{{ route('active-student-letter.index') }}" class="btn btn-sm btn-primary">Kembali</a>
            @if ($activeStudentLetter->letter->verified())
            <a target="_blank" href="{{ route('active-student-letter.print', ['activeStudentLetter' => $activeStudentLetter]) }}" class="btn btn-sm btn-primary">Cetak</a>
            @else
            @if ($activeStudentLetter->letter->waiting())
            @if (can('update-active-student-letter'))
            <a href="{{ route('active-student-letter.edit', ['activeStudentLetter' => $activeStudentLetter]) }}" class="btn btn-sm btn-primary">Edit</a>
            @endif
            @if (can('update-active-student-letter-verification'))
            <button data-bs-toggle="modal" data-bs-target="#verify-modal" type="button" class="btn btn-sm btn-primary">Verifikasi</button>
            @endif
            @if (can('update-active-student-letter-verification'))
            <button data-bs-toggle="modal" data-bs-target="#reject-modal" type="button" class="btn btn-sm btn-primary">Tolak</button>
            @endif
            @endif
            @endif
            @if (can('delete-active-student-letter'))
            <form class="d-inline" action="{{ route('active-student-letter.destroy', ['activeStudentLetter' => $activeStudentLetter]) }}" method="post">
                @csrf
                @method('delete')
                <button onclick="return confirm('Hapus surat?')" type="submit" class="btn btn-sm btn-danger">Hapus</button>
            </form>
            @endif
        </div>
        <div>
            @if ($activeStudentLetter->letter->verified())
            <div role="alert" class="alert alert-light-success">
                <h6 class="fw-bold">Status: {{ $activeStudentLetter->letter->status }}</h6>
                <p>{{ $activeStudentLetter->letter->note }}</p>
            </div>
            @elseif ($activeStudentLetter->letter->rejected())
            <div role="alert" class="alert alert-light-danger">
                <h6 class="fw-bold">Status: {{ $activeStudentLetter->letter->status }}</h6>
                <p>{{ $activeStudentLetter->letter->note }}</p>
            </div>
            @elseif ($activeStudentLetter->letter->waiting())
            <div role="alert" class="alert alert-light-warning">
                <h6 class="fw-bold">Status: {{ $activeStudentLetter->letter->status }}</h6>
                <p>{{ $activeStudentLetter->letter->note }}</p>
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
                            <td>{{ $activeStudentLetter->letter->created_at->isoFormat('DD MMMM Y') }}</td>
                        </tr>
                        <tr>
                            <td>Nomor Surat</td>
                            <td>:</td>
                            <td>
                                @if ($activeStudentLetter->letter->letter_number == null)
                                <span class="badge bg-light-danger">Tidak ada</span>
                                @else
                                {{ $activeStudentLetter->letter->letter_number }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Nama Mahasiswa</td>
                            <td>:</td>
                            <td>{{ $activeStudentLetter->student->name }}</td>
                        </tr>
                        <tr>
                            <td>Nomor Induk</td>
                            <td>:</td>
                            <td>{{ $activeStudentLetter->student->student_number }}</td>
                        </tr>
                        <tr>
                            <td>Maksud/Keperluan</td>
                            <td>:</td>
                            <td>{{ $activeStudentLetter->purpose }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<x-modal modal-id="verify-modal" modal-title="Verifikasi surat" modal-size="">
    <form action="{{ route('active-student-letter.verify', ['activeStudentLetter' => $activeStudentLetter]) }}" method="POST">
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
    <form action="{{ route('active-student-letter.reject', ['activeStudentLetter' => $activeStudentLetter]) }}" method="POST">
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