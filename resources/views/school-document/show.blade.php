@extends('layouts.base')

@section('content')
<h3 class="mb-4">Detail Arsip Dokumen Universitas</h3>
<div class="mb-3">
    <a href="{{ route('school-document.index') }}" class="btn btn-sm btn-primary">Kembali</a>
    @if (can('update-school-document'))
    <a href="{{ route('school-document.edit', ['schoolDocument' => $schoolDocument]) }}" class="btn btn-sm btn-primary">Edit</a>
    @endif
    @if (can('delete-school-document'))
    <form action="{{ route('school-document.destroy', ['schoolDocument' => $schoolDocument]) }}" class="d-inline" method="POST">
        @csrf
        @method('delete')
        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus dokumen?')">Hapus</button>
    </form>
    @endif
</div>
<div class="row">
    <div class="col-lg-4">
        <h5 class="mb-3">Keterangan</h5>
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td>Nomor Arsip</td>
                            <td>:</td>
                            <td><code>{{ $schoolDocument->archive->number }}</code></td>
                        </tr>
                        <tr>
                            <td>Nama Dokumen</td>
                            <td>:</td>
                            <td>{{ $schoolDocument->name }}</td>
                        </tr>
                        <tr>
                            <td>Nomor Dokumen</td>
                            <td>:</td>
                            <td>{{ $schoolDocument->number }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Dokumen</td>
                            <td>:</td>
                            <td>{{ $schoolDocument->date->isoFormat('DD MMMM Y') }}</td>
                        </tr>
                        <tr>
                            <td>Deskripsi</td>
                            <td>:</td>
                            <td>{{ $schoolDocument->description }}</td>
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
                    <object border="0" data="{{ asset('storage/' . $schoolDocument->file) }}#toolbar=0" type="application/pdf" width="100%" height="600px">
                        <p class="text-muted">Browser anda tidak mendukung untuk melihat file pdf.
                            Klik <a href="{{ asset('storage/' . $schoolDocument->file) }}">di sini</a>
                            untuk mendownload file arsip.</p>
                    </object>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection