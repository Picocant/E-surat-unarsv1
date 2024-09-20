@extends('layouts.base')

@section('content')
    <h3 class="mb-4">Data Surat Masuk</h3>
    @if (can('create-incoming-letter'))
        <div class="mb-3">
            <a href="{{ route('incoming-letter.create') }}" class="btn btn-primary btn-sm">Tambah Data</a>
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
                                <th>Kategori</th>
                                <th>Tanggal</th>
                                <th>Asal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($incomingLetters as $incomingLetter)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $incomingLetter->letter_number }}</td>
                                    <td>{{ $incomingLetter->incoming_letter_category->name }}</td>
                                    <td>{{ $incomingLetter->date->isoFormat('DD MMMM Y') }}</td>
                                    <td>{{ $incomingLetter->from }}</td>
                                    <td nowrap>
                                        <a href="{{ route('incoming-letter.show', ['incomingLetter' => $incomingLetter]) }}"
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
