@extends('layouts.base')

@section('content')
    <h3 class="mb-4">Data Kategori Surat Masuk</h3>
    @if (can('create-incoming-letter-category'))
        <div class="mb-3">
            <form class="row g-3" action="{{ route('incoming-letter-category.store') }}" method="POST">
                @csrf
                <div class="col-auto">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nama kategori baru">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3">Tambah Data</button>
                </div>
            </form>
        </div>
    @endif
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kategori</th>
                                <th>Jumlah Surat Masuk</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                                <tr x-data="{ edit: false }">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <template x-if="!edit">
                                            <span>
                                                {{ $category->name }}
                                            </span>
                                        </template>
                                        <template x-if="edit">
                                            <form class="row g-3"
                                                action="{{ route('incoming-letter-category.update', ['incomingLetterCategory' => $category]) }}"
                                                method="POST">
                                                @csrf
                                                @method('put')
                                                <div class="col-auto">
                                                    <input required type="text" class="form-control form-control-sm"
                                                        id="name" name="name" value="{{ $category->name }}">
                                                </div>
                                                <div class="col-auto">
                                                    <button type="submit"
                                                        class="btn btn-light-primary btn-sm mb-3">Simpan</button>
                                                    <button type="button" x-on:click="edit=false"
                                                        class="btn btn-light-danger btn-sm mb-3">Batal</button>
                                                </div>
                                            </form>
                                        </template>
                                    </td>
                                    <td>{{ $category->incoming_letters->count() }}</td>
                                    <td>
                                        @if (can('update-incoming-letter-category'))
                                            <button x-on:click="edit=true" x-show="!edit"
                                                class="btn btn-sm btn-light-primary">Edit</button>
                                        @endif
                                        @if (can('delete-incoming-letter-category'))
                                            <form method="POST"
                                                action="{{ route('incoming-letter-category.destroy', ['incomingLetterCategory' => $category]) }}"
                                                class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="submit"
                                                    onclick="return confirm('Hapus kategori {{ $category->name }}?')"
                                                    class="btn btn-sm btn-light-danger">Hapus</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
