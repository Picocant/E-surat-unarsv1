@extends('layouts.base')

@section('content')
<div class="row">
    <div class="col-lg-6 mx-auto">
        <h3 class="mb-4">Tambah Arsip Dokumen Universitas</h3>
        <div class="mb-3">
            <a href="{{ route('school-document.index') }}" class="btn btn-sm btn-primary">Kembali</a>
        </div>
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <form action="{{ route('school-document.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="form-label">Nama Dokumen</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label for="number" class="form-label">Nomor Dokumen</label>
                            <input type="text" name="number" id="number" class="form-control" value="{{ old('number') }}">
                        </div>
                        <div class="form-group">
                            <label for="date" class="form-label">Tanggal Dokumen</label>
                            <input type="date" name="date" id="date" class="form-control" value="{{ old('date') }}">
                        </div>
                        <div class="form-group">
                            <label for="file" class="form-label">File Dokumen (pdf)</label>
                            <input type="file" name="file" id="file" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="description" class="form-label">Keterangan</label>
                            <textarea name="description" class="form-control" id="description">{{ old('description') }}</textarea>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection