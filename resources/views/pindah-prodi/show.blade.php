@extends('layouts.base')

@section('content')
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <h3 class="mb-4">Surat Keterangan Pindah Prodi</h3>
            <div class="mb-3">
                <a href="{{ route('pindah-prodi.index') }}" class="btn btn-sm btn-primary">Kembali</a>
                @if ($pindahprodi->letter->verified())
                    <a target="_blank"
                        href="{{ route('pindah-prodi.print', ['pindahprodi' => $pindahprodi]) }}"
                        class="btn btn-sm btn-primary">Cetak</a>
                @else
                    @if ($pindahprodi->letter->waiting())
                        @if (can('update-pindah-prodi'))
                            <a href="{{ route('pindah-prodi.edit', ['pindahprodi' => $pindahprodi]) }}"
                                class="btn btn-sm btn-primary">Edit</a>
                        @endif
                        @if (can('update-pindah-prodi-verification'))
                            <button type="button" data-bs-toggle="modal" data-bs-target="#verify-modal"
                                class="btn btn-sm btn-primary">Verifikasi</button>
                        @endif
                        @if (can('update-pindah-prodi-verification'))
                            <button type="button" data-bs-toggle="modal" data-bs-target="#reject-modal"
                                class="btn btn-sm btn-primary">Tolak</button>
                        @endif
                    @endif
                @endif
                @if (can('delete-pindah-prodi'))
                    <form class="d-inline"
                        action="{{ route('pindah-prodi.destroy', ['pindahprodi' => $pindahprodi]) }}"
                        method="post">
                        @csrf
                        @method('delete')
                        <button onclick="return confirm('Hapus surat?')" type="submit"
                            class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                @endif
            </div>
            <div>
                @if ($pindahprodi->letter->verified())
                    <div role="alert" class="alert alert-light-success">
                        <h6 class="fw-bold">Status: {{ $pindahprodi->letter->status }}</h6>
                        <p>{{ $pindahprodi->letter->note }}</p>
                    </div>
                @elseif ($pindahprodi->letter->rejected())
                    <div role="alert" class="alert alert-light-danger">
                        <h6 class="fw-bold">Status: {{ $pindahprodi->letter->status }}</h6>
                        <p>{{ $pindahprodi->letter->note }}</p>
                    </div>
                @elseif ($pindahprodi->letter->waiting())
                    <div role="alert" class="alert alert-light-warning">
                        <h6 class="fw-bold">Status: {{ $pindahprodi->letter->status }}</h6>
                        <p>{{ $pindahprodi->letter->note }}</p>
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
                                <td>{{ $pindahprodi->letter->created_at->isoFormat('DD MMMM Y') }}</td>
                            </tr>
                            <tr>
                                <td>Nomor Surat</td>
                                <td>:</td>
                                <td>
                                    @if ($pindahprodi->letter->letter_number == null)
                                        <span class="badge bg-light-danger">Tidak ada</span>
                                    @else
                                        {{ $pindahprodi->letter->letter_number }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Nama Siswa</td>
                                <td>:</td>
                                <td>{{ $pindahprodi->student->name }}</td>
                            </tr>
                            <tr>
                                <td>Nomor Induk</td>
                                <td>:</td>
                                <td>{{ $pindahprodi->student->student_number }}</td>
                            </tr>
                            <tr>
                                <td>Tujuan Prodi Baru</td>
                                <td>:</td>
                                <td>{{ $pindahprodi->new_prodi }}</td>
                            </tr>
                            <tr>
                                <td>Alasan Pindah</td>
                                <td>:</td>
                                <td>{{ $pindahprodi->reason }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-modal modal-id="verify-modal" modal-title="Verifikasi surat" modal-size="">
        <form action="{{ route('pindah-prodi.verify', ['pindahprodi' => $pindahprodi]) }}"
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
        <form action="{{ route('pindah-prodi.reject', ['pindahprodi' => $pindahprodi]) }}"
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
