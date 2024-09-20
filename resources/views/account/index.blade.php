@extends('layouts.base')

@section('content')
    <h3 class="mb-4">Akun Saya</h3>
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <img class="img-fluid rounded" width="200" src="{{ $user->avatar() }}">
                        </div>
                        <div class="text-center my-2">
                            <form method="POST" action="{{ route('account.change-avatar') }}" class="d-inline"
                                enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <label role="button" for="avatar" class="link-primary">Ubah Gambar</label>
                                <input onchange="this.parentElement.submit()" type="file" name="avatar" id="avatar"
                                    style="display: none;">
                            </form>
                            @if ($user->avatar != null)
                                <form action="{{ route('account.delete-avatar') }}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="link-danger border-0 bg-transparent p-0 d-inline">Hapus
                                        Gambar</button>
                                </form>
                            @endif
                        </div>
                        <div class="text-center">
                            <h2>{{ $user->name }}</h2>
                            <p class="mb-0">Role. {{ $user->role }}</p>
                            @if ($user->nip != null || $user->nip != '')
                                <p>NIP. {{ $user->nip }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Profil</h4>
                        <form class="form form-vertical" action="{{ route('account.update') }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="name" class="form-label">Nama Lengkap</label>
                                            <input type="text" id="name" class="form-control" name="name"
                                                value="{{ old('name', $user->name) }}">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" id="email" class="form-control" name="email"
                                                value="{{ old('email', $user->email) }}">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="nip" class="form-label">NIP</label>
                                            <input type="text" id="nip" class="form-control" name="nip"
                                                value="{{ old('nip', $user->nip) }}">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="date_of_bird" class="form-label">Tanggal Lahir</label>
                                            <input type="date" id="date_of_bird" class="form-control" name="date_of_bird"
                                                value="{{ old('date_of_bird', $user->date_of_bird ? $user->date_of_bird->format('Y-m-d') : '') }}">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="address" class="form-label">Alamat</label>
                                            <textarea id="address" class="form-control" name="address">{{ old('address', $user->address) }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            @if (can('change-account-position'))
                                                <label for="position_id" class="form-label">Jabatan</label>
                                                <select class="form-select" id="position_id" name="position_id">
                                                    @foreach ($positions as $position)
                                                        <option
                                                            {{ old('position_id', $user->position_id) === $position->id ? 'selected' : '' }}
                                                            value="{{ $position->id }}">{{ $position->name }}</option>
                                                    @endforeach
                                                </select>
                                            @else
                                                @if ($user->position)
                                                    <label for="position" class="form-label">Jabatan</label>
                                                    <input type="text" id="position" value="{{ $user->position->name }}"
                                                        disabled class="form-control">
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            @if (can('change-account-role'))
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Ubah Role</h4>
                            <form class="form form-vertical" action="{{ route('account.change-role') }}" method="POST">
                                @csrf
                                @method('put')
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <select class="form-select" id="role" name="role">
                                                    @foreach ($roles as $role)
                                                        <option {{ $user->roles === $role ? 'selected' : '' }}
                                                            value="{{ $role }}">{{ $role }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Ubah Kata Sandi</h4>
                        <form class="form form-vertical" action="{{ route('account.change-password') }}" method="POST">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="old_password" class="form-label">Kata sandi lama</label>
                                            <input type="password" id="old_password" class="form-control"
                                                name="old_password">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="password" class="form-label">Kata sandi baru</label>
                                            <input type="password" id="password" class="form-control" name="password">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="password_confirmation" class="form-label">Ulangi kata sandi
                                                baru</label>
                                            <input type="password" id="password_confirmation" class="form-control"
                                                name="password_confirmation">
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
