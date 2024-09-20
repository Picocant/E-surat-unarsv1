@extends('layouts.base')

@section('content')
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <h3 class="mb-4">Surat Perintah Perjalanan Dinas</h3>
            <div class="mb-3">
                <a href="{{ route('sppd-letter.index') }}" class="btn btn-sm btn-primary">Kembali</a>
                @if ($sppdLetter->letter->verified())
                    <a target="_blank" href="{{ route('sppd-letter.print', ['sppdLetter' => $sppdLetter]) }}"
                        class="btn btn-sm btn-primary">Cetak</a>
                @else
                    @if ($sppdLetter->letter->waiting())
                        @if (can('update-sppd-letter'))
                            <a href="{{ route('sppd-letter.edit', ['sppdLetter' => $sppdLetter]) }}"
                                class="btn btn-sm btn-primary">Edit</a>
                        @endif
                        @if (can('update-sppd-letter-verification'))
                            <button type="button" data-bs-toggle="modal" data-bs-target="#verify-modal"
                                class="btn btn-sm btn-primary">Verifikasi</button>
                        @endif
                        @if (can('update-sppd-letter-verification'))
                            <button type="button" data-bs-toggle="modal" data-bs-target="#reject-modal"
                                class="btn btn-sm btn-primary">Tolak</button>
                        @endif
                    @endif
                @endif
                @if (can('delete-sppd-letter'))
                    <form class="d-inline" action="{{ route('sppd-letter.destroy', ['sppdLetter' => $sppdLetter]) }}"
                        method="post">
                        @csrf
                        @method('delete')
                        <button onclick="return confirm('Hapus surat?')" type="submit"
                            class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                @endif
            </div>
            <div>
                @if ($sppdLetter->letter->verified())
                    <div role="alert" class="alert alert-light-success">
                        <h6 class="fw-bold">Status: {{ $sppdLetter->letter->status }}</h6>
                        <p>{{ $sppdLetter->letter->note }}</p>
                    </div>
                @elseif ($sppdLetter->letter->rejected())
                    <div role="alert" class="alert alert-light-danger">
                        <h6 class="fw-bold">Status: {{ $sppdLetter->letter->status }}</h6>
                        <p>{{ $sppdLetter->letter->note }}</p>
                    </div>
                @elseif ($sppdLetter->letter->waiting())
                    <div role="alert" class="alert alert-light-warning">
                        <h6 class="fw-bold">Status: {{ $sppdLetter->letter->status }}</h6>
                        <p>{{ $sppdLetter->letter->note }}</p>
                    </div>
                @endif
            </div>
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h6>Data Surat</h6>
                        <table class="table">
                            <tr>
                                <td>Tanggal Surat</td>
                                <td>:</td>
                                <td>{{ $sppdLetter->letter->created_at->isoFormat('DD MMMM Y') }}</td>
                            </tr>
                            <tr>
                                <td>Nomor Surat</td>
                                <td>:</td>
                                <td>
                                    @if ($sppdLetter->letter->letter_number == null)
                                        <span class="badge bg-light-danger">Tidak ada</span>
                                    @else
                                        {{ $sppdLetter->letter->letter_number }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Nama Pemberi Perintah</td>
                                <td>:</td>
                                <td>
                                    <strong>{{ $sppdLetter->from->name }}</strong>
                                    @if ($fromPosition = $sppdLetter->from->position)
                                        <br>
                                        {{ $fromPosition->name }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Melakukan Perjalanan Ke</td>
                                <td>:</td>
                                <td>{{ $sppdLetter->destination }}</td>
                            </tr>
                            <tr>
                                <td>Dengan maksud/tujuan</td>
                                <td>:</td>
                                <td>{{ $sppdLetter->purpose }}</td>
                            </tr>
                            <tr>
                                <td>Anggaran</td>
                                <td>:</td>
                                <td>@currency($sppdLetter->budget)</td>
                            </tr>
                        </table>
                        <h6>Nama Penerima Perintah</h6>
                        <ol>
                            @foreach ($sppdLetter->recipients as $recipient)
                                <li>
                                    {{ $recipient->user->name }}
                                    @if ($nip = $recipient->user->nip)
                                        <br>
                                        NIP. {{ $nip }}
                                    @endif
                                </li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-modal modal-id="verify-modal" modal-title="Verifikasi surat" modal-size="">
        <form action="{{ route('sppd-letter.verify', ['sppdLetter' => $sppdLetter]) }}" method="POST">
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
        <form action="{{ route('sppd-letter.reject', ['sppdLetter' => $sppdLetter]) }}" method="POST">
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
