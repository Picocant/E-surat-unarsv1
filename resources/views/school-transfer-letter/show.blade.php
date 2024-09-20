@extends('layouts.base')

@section('content')
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <h3 class="mb-4">Surat Keterangan Pindah Universitas</h3>
            <div class="mb-3">
                <a href="{{ route('school-transfer-letter.index') }}" class="btn btn-sm btn-primary">Kembali</a>
                @if ($schoolTransferLetter->letter->verified())
                    <a target="_blank"
                        href="{{ route('school-transfer-letter.print', ['schoolTransferLetter' => $schoolTransferLetter]) }}"
                        class="btn btn-sm btn-primary">Cetak</a>
                @else
                    @if ($schoolTransferLetter->letter->waiting())
                        @if (can('update-school-transfer-letter'))
                            <a href="{{ route('school-transfer-letter.edit', ['schoolTransferLetter' => $schoolTransferLetter]) }}"
                                class="btn btn-sm btn-primary">Edit</a>
                        @endif
                        @if (can('update-school-transfer-letter-verification'))
                            <button type="button" data-bs-toggle="modal" data-bs-target="#verify-modal"
                                class="btn btn-sm btn-primary">Verifikasi</button>
                        @endif
                        @if (can('update-school-transfer-letter-verification'))
                            <button type="button" data-bs-toggle="modal" data-bs-target="#reject-modal"
                                class="btn btn-sm btn-primary">Tolak</button>
                        @endif
                    @endif
                @endif
                @if (can('delete-school-transfer-letter'))
                    <form class="d-inline"
                        action="{{ route('school-transfer-letter.destroy', ['schoolTransferLetter' => $schoolTransferLetter]) }}"
                        method="post">
                        @csrf
                        @method('delete')
                        <button onclick="return confirm('Hapus surat?')" type="submit"
                            class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                @endif
            </div>
            <div>
                @if ($schoolTransferLetter->letter->verified())
                    <div role="alert" class="alert alert-light-success">
                        <h6 class="fw-bold">Status: {{ $schoolTransferLetter->letter->status }}</h6>
                        <p>{{ $schoolTransferLetter->letter->note }}</p>
                    </div>
                @elseif ($schoolTransferLetter->letter->rejected())
                    <div role="alert" class="alert alert-light-danger">
                        <h6 class="fw-bold">Status: {{ $schoolTransferLetter->letter->status }}</h6>
                        <p>{{ $schoolTransferLetter->letter->note }}</p>
                    </div>
                @elseif ($schoolTransferLetter->letter->waiting())
                    <div role="alert" class="alert alert-light-warning">
                        <h6 class="fw-bold">Status: {{ $schoolTransferLetter->letter->status }}</h6>
                        <p>{{ $schoolTransferLetter->letter->note }}</p>
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
                                <td>{{ $schoolTransferLetter->letter->created_at->isoFormat('DD MMMM Y') }}</td>
                            </tr>
                            <tr>
                                <td>Nomor Surat</td>
                                <td>:</td>
                                <td>
                                    @if ($schoolTransferLetter->letter->letter_number == null)
                                        <span class="badge bg-light-danger">Tidak ada</span>
                                    @else
                                        {{ $schoolTransferLetter->letter->letter_number }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Nama Siswa</td>
                                <td>:</td>
                                <td>{{ $schoolTransferLetter->student->name }}</td>
                            </tr>
                            <tr>
                                <td>Nomor Induk</td>
                                <td>:</td>
                                <td>{{ $schoolTransferLetter->student->student_number }}</td>
                            </tr>
                            <tr>
                                <td>Tujuan Sekolah Baru</td>
                                <td>:</td>
                                <td>{{ $schoolTransferLetter->new_school }}</td>
                            </tr>
                            <tr>
                                <td>Alasan Pindah</td>
                                <td>:</td>
                                <td>{{ $schoolTransferLetter->reason }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-modal modal-id="verify-modal" modal-title="Verifikasi surat" modal-size="">
        <form action="{{ route('school-transfer-letter.verify', ['schoolTransferLetter' => $schoolTransferLetter]) }}"
            method="POST">
            @csrf
            @method('put')
            <div class="form-group">
                <label class="form-label" for="note">Catatan Verifikasi</label>
                <textarea class="form-control" name="note" id="note" rows="3"></textarea>
            </div>
            <button onclick="return confirm('Verifikasi surat ini?')" type="submit"
                class="btn btn-sm btn-primary">Verifikasi</button>
        </form>
    </x-modal>
    <x-modal modal-id="reject-modal" modal-title="Tolak surat" modal-size="">
        <form action="{{ route('school-transfer-letter.reject', ['schoolTransferLetter' => $schoolTransferLetter]) }}"
            method="POST">
            @csrf
            @method('put')
            <div class="form-group">
                <label class="form-label" for="note">Catatan Penolakan</label>
                <textarea class="form-control" name="note" id="note" rows="3"></textarea>
            </div>
            <button onclick="return confirm('Tolak surat ini?')" type="submit"
                class="btn btn-sm btn-primary">Tolak</button>
        </form>
    </x-modal>
@endsection
