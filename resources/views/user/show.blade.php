@extends('layouts.base')

@section('content')
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="card mb-4">
                <div class="card-content">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <img class="img-fluid" width="200" src="{{ $user->avatar() }}">
                        </div>
                        <div class="text-center my-2">
                            <form method="POST" action="{{ route('user.change-avatar', ['user' => $user]) }}"
                                class="d-inline" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <label role="button" for="avatar" class="link-primary">Ubah Gambar</label>
                                <input onchange="this.parentElement.submit()" type="file" name="avatar" id="avatar"
                                    style="display: none;">
                            </form>
                            @if ($user->avatar != null)
                                <form action="{{ route('account.delete-avatar') }}" method="post" class="d-inline">
                                    @csrf
                                    <button type="submit" class="link-danger border-0 bg-transparent p-0 d-inline">Hapus
                                        Gambar</button>
                                </form>
                            @endif
                        </div>
                        <div class="text-center">
                            <h2>{{ $user->name }}</h2>
                            <p class="mb-0">Role. {{ $user->role }}</p>
                        </div>
                        <div class="mt-3 text-center">
                            <a href="{{ route('user.index') }}" class="btn btn-sm btn-primary">Kembali</a>
                            @if (can('update-user'))
                                <a href="{{ route('user.edit', ['user' => $user]) }}"
                                    class="btn btn-primary btn-sm">Edit</a>
                                <form method="POST" action="{{ route('user.reset-password', ['user' => $user]) }}"
                                    class="d-inline">
                                    @csrf
                                    @method('put')
                                    <button onclick="return confirm('Reset kata sandi untuk akun ini?')"
                                        class="btn btn-sm btn-primary">Reset Kata Sandi</button>
                                </form>
                            @endif
                            @if (can('delete-user'))
                                <form method="POST" action="{{ route('user.destroy', ['user' => $user]) }}"
                                    class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button onclick="return confirm('Hapus {{ $user->name }}?')" type="submit"
                                        class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            @endif
                        </div>
                        @if (!$user->is_active)
                            <div class="alert alert-light-danger mt-3 mb-0" role="alert">
                                Akun ini tidak aktif!
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name" class="form-label">Nama Lengkap</label>
                                    <input disabled type="text" id="name" class="form-control" name="name"
                                        value="{{ $user->name }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <input disabled type="email" id="email" class="form-control" name="email"
                                        value="{{ $user->email }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nip" class="form-label">NIP</label>
                                    <input disabled type="text" id="nip" class="form-control" name="nip"
                                        value="{{ $user->nip ? $user->nip : '-' }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="date_of_bird" class="form-label">Tanggal Lahir</label>
                                    <input disabled type="date" id="date_of_bird" class="form-control"
                                        name="date_of_bird"
                                        value="{{ $user->date_of_bird ? $user->date_of_bird->format('Y-m-d') : '' }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="address" class="form-label">Alamat</label>
                                    <textarea disabled id="address" class="form-control" name="address">{{ $user->address ? $user->address : '-' }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="position_id" class="form-label">Jabatan</label>
                                    <input disabled type="text" id="position_id" class="form-control" name="position_id"
                                        value="{{ $user->position_id ? $user->position->name : '-' }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
