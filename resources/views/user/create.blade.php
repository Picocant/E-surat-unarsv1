@extends('layouts.base')

@section('content')
    <h3 class="mb-4">Tambah Data Pengguna</h3>
    <div class="mb-3">
        <a href="{{ route('user.index') }}" class="btn btn-sm btn-primary">Kembali</a>
    </div>
    <form action="{{ route('user.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-lg-7">
                <h5 class="mb-3">Data Pengguna</h5>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name" class="sr-only form-label">Nama lengkap</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                            </div>
                            <div class="form-group">
                                <label for="nip" class="form-label">NIP</label>
                                <div>format: xxxxxxxx xxxxxx x xxx</div>
                                <input placeholder="contoh 19730926 201505 1 009" type="text" id="nip" class="form-control" name="nip"
                                    value="{{ old('nip') }}">
                            </div>
                            <div class="form-group">
                                <label for="date_of_bird" class="form-label">Tanggal Lahir</label>
                                <input type="date" id="date_of_bird" class="form-control" name="date_of_bird"
                                    value="{{ old('date_of_bird') }}">
                            </div>
                            <div class="form-group">
                                <label for="address" class="form-label">Alamat</label>
                                <textarea id="address" class="form-control" name="address">{{ old('address') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                            </div>
                            <div class="form-group">
                                <label for="role" class="form-label">Role</label>
                                <select class="form-select" id="role" name="role">
                                    @foreach ($roles as $role)
                                        <option {{ old('role') === $role ? 'selected' : '' }} value="{{ $role }}">
                                            {{ $role }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="gender" class="form-label">Jenis Kelamin</label>
                                <select class="form-select" id="gender" name="gender">
                                    @foreach ($genders as $gender)
                                        <option {{ old('gender') === $gender ? 'selected' : '' }}
                                            value="{{ $gender }}">
                                            {{ $gender }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-3 text-end">
                                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <h5 class="mb-3">Jabatan</h5>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            @foreach ($positions as $position)
                                <div class="form-check">
                                    <input {{ old('position_id') == $position->id ? 'checked' : '' }}
                                        value="{{ $position->id }}" class="form-check-input" type="radio"
                                        name="position_id" id="position-{{ $position->id }}">
                                    <label class="form-check-label" for="position-{{ $position->id }}">
                                        {{ $position->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
