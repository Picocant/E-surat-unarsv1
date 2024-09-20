@extends('layouts.base')

@section('content')
    <h3 class="mb-4">Data Disposisi Surat Masuk</h3>
    @if (can('create-incoming-letter-disposition'))
        <div class="mb-3">
            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                data-bs-target="#choose-incoming-letter">
                Buat Disposisi
            </button>
        </div>
    @endif
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="datatable">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Tanggal Disposisi</th>
                                <th>Nomor Surat</th>
                                <th>Tanggal Surat</th>
                                <th>Asal Surat</th>
                                <th>Perihal</th>
                                <th>Tujuan Disposisi</th>
                                <th>Sifat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($incomingLetterDispositions as $incomingLetterDisposition)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $incomingLetterDisposition->created_at->isoFormat('DD MMMM Y') }}</td>
                                    <td>{{ $incomingLetterDisposition->incoming_letter->letter_number }}</td>
                                    <td>{{ $incomingLetterDisposition->incoming_letter->date->isoFormat('DD MMMM Y') }}
                                    </td>
                                    <td>{{ $incomingLetterDisposition->incoming_letter->from }}</td>
                                    <td>{{ $incomingLetterDisposition->incoming_letter->regarding }}</td>
                                    <td>{{ $incomingLetterDisposition->to }}</td>
                                    <td>{{ $incomingLetterDisposition->type }}</td>
                                    <td nowrap>
                                        <a href="{{ route('incoming-letter-disposition.show', ['incomingLetterDisposition' => $incomingLetterDisposition]) }}"
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
    <x-incoming-letter-disposition.choose-incoming-letter-modal />
@endsection
