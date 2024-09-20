@extends('layouts.base')

@section('content')
<h3 class="mb-4">Dokumen Penting Universitas</h3>
@if (can('create-school-document'))
<div class="mb-3">
    <a href="{{ route('school-document.create') }}" class="btn btn-sm btn-primary">Tambah Data</a>
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
                            <th>Nomor Arsip</th>
                            <th>Nama Dokumen</th>
                            <th>Nomor Dokumen</th>
                            <th>Tanggal Dokumen</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($schoolDocuments as $schoolDocument)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><code>{{ $schoolDocument->archive->number }}</code></td>
                            <td>{{ $schoolDocument->name }}</td>
                            <td>{{ $schoolDocument->number }}</td>
                            <td>{{ $schoolDocument->date->isoFormat('DD MMMM Y') }}</td>
                            <td>
                                <a href="{{ route('school-document.show', ['schoolDocument' => $schoolDocument]) }}" class="btn btn-sm btn-light-primary">Detail</a>
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