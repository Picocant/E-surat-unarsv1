@extends('layouts.base')

@section('content')
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <h3 class="mb-4">Detail Disposisi Surat</h3>
            <div class="mb-3">
                <a href="{{ route('incoming-letter-disposition.index') }}" class="btn btn-sm btn-primary">Kembali</a>
                @if (can('update-incoming-letter-disposition'))
                    <a href="{{ route('incoming-letter-disposition.edit', ['incomingLetterDisposition' => $incomingLetterDisposition]) }}?incoming_letter_id={{ $incomingLetterDisposition->incoming_letter->id }}"
                        class="btn btn-sm btn-primary">Edit</a>
                @endif
                <a target="_blank"
                    href="{{ route('incoming-letter-disposition.print', ['incomingLetterDisposition' => $incomingLetterDisposition]) }}?incoming_letter_id={{ $incomingLetterDisposition->incoming_letter->id }}"
                    class="btn btn-sm btn-primary">Cetak</a>
                @if (can('delete-incoming-letter-disposition'))
                    <form class="d-inline"
                        action="{{ route('incoming-letter-disposition.destroy', ['incomingLetterDisposition' => $incomingLetterDisposition]) }}"
                        method="post">
                        @csrf
                        @method('delete')
                        <button onclick="return confirm('Hapus disposisi?')" type="submit"
                            class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                @endif
            </div>
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <td>Tanggal Disposisi</td>
                                <td>{{ $incomingLetterDisposition->created_at->isoFormat('DD MMMM Y') }}</td>
                            </tr>
                            <tr>
                                <td>Tujuan Disposisi</td>
                                <td>{{ $incomingLetterDisposition->to }}</td>
                            </tr>
                            <tr>
                                <td>Nomor Surat</td>
                                <td>{{ $incomingLetterDisposition->incoming_letter->letter_number }} - (<a
                                        data-bs-toggle="modal" data-bs-target="#show-incoming-letter-modal" role="button"
                                        href="#" class="alert-link">Lihat Surat</a>)</td>
                            </tr>
                            <tr>
                                <td>Tanggal Surat</td>
                                <td>{{ $incomingLetterDisposition->incoming_letter->date->isoFormat('DD MMMM Y') }}</td>
                            </tr>
                            <tr>
                                <td>Asal Surat</td>
                                <td>{{ $incomingLetterDisposition->incoming_letter->from }}</td>
                            </tr>
                            <tr>
                                <td>Perihal</td>
                                <td>{{ $incomingLetterDisposition->incoming_letter->regarding }}</td>
                            </tr>
                            <tr>
                                <td>Sifat Disposisi</td>
                                <td>{{ $incomingLetterDisposition->type }}</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    Isi Disposisi:
                                    <br>
                                    {{ $incomingLetterDisposition->message }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-modal modal-id="show-incoming-letter-modal" modal-title="Surat Masuk" modal-size="modal-lg">
        <object border="0" data="{{ asset('storage/' . $incomingLetterDisposition->incoming_letter->file) }}#toolbar=0"
            type="application/pdf" width="100%" height="600px">
            <p class="text-muted">Browser anda tidak mendukung untuk melihat file pdf.
                Klik <a href="{{ asset('storage/' . $incomingLetterDisposition->incoming_letter->file) }}">di sini</a>
                untuk mendownload file arsip.</p>
        </object>
    </x-modal>
@endsection
