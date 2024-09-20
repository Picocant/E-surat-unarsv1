@extends('layouts.base')

@section('content')
    <h3 class="mb-4">Detail Surat Masuk</h3>
    <div class="mb-3">
        <a href="{{ route('incoming-letter.index') }}" class="btn btn-sm btn-primary">Kembali</a>
        @if (can('update-incoming-letter'))
            <a href="{{ route('incoming-letter.edit', ['incomingLetter' => $incomingLetter]) }}"
                class="btn btn-sm btn-primary">Edit</a>
        @endif
        @if (can('read-incoming-letter-disposition'))
            @if ($incomingLetter->incoming_letter_disposition != null)
                <a href="#" onclick="alert('Not implemented'); return false;" class="btn btn-primary btn-sm">Disposisi</a>
            @endif
        @endif
        @if (can('delete-incoming-letter'))
            <form action="{{ route('incoming-letter.destroy', ['incomingLetter' => $incomingLetter]) }}" method="POST"
                class="d-inline">
                @csrf
                @method('delete')
                <button onclick="return confirm('Hapus data surat ini?')" type="submit"
                    class="btn btn-sm btn-danger">Hapus</button>
            </form>
        @endif
    </div>
    <div class="row">
        <div class="col-lg-4">
            <h5 class="mb-3">Data Surat</h5>
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <td>Nomor</td>
                                <td>:</td>
                                <td>{{ $incomingLetter->letter_number }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <td>:</td>
                                <td>{{ $incomingLetter->date->isoFormat('DD MMMM Y') }}</td>
                            </tr>
                            <tr>
                                <td>Perihal</td>
                                <td>:</td>
                                <td>{{ $incomingLetter->regarding }}</td>
                            </tr>
                            <tr>
                                <td>Lampiran</td>
                                <td>:</td>
                                <td>{{ $incomingLetter->attachment }}</td>
                            </tr>
                            <tr>
                                <td>Asal</td>
                                <td>:</td>
                                <td>{{ $incomingLetter->from }}</td>
                            </tr>
                            <tr>
                                <td>Tujuan</td>
                                <td>:</td>
                                <td>{{ $incomingLetter->to }}</td>
                            </tr>
                            <tr>
                                <td>Kategori</td>
                                <td>:</td>
                                <td>{{ $incomingLetter->incoming_letter_category->name }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <h5 class="mb-3">File Preview</h5>
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <object border="0" data="{{ asset('storage/' . $incomingLetter->file) }}#toolbar=0"
                            type="application/pdf" width="100%" height="600px">
                            <p class="text-muted">Browser anda tidak mendukung untuk melihat file pdf.
                                Klik <a href="{{ asset('storage/' . $incomingLetter->file) }}">di sini</a>
                                untuk mendownload file arsip.</p>
                        </object>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
