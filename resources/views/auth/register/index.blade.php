@extends('layouts.base')

@section('content')
    <div class="row">
        <div class="col-lg-5 mx-auto">
            <h2 class="text-center mb-4">Buat Akun</h2>
            <div class="card mb-3">
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" method="post" action="{{ route('register.attempt') }}">
                            @csrf
                            <div class="form-body">
                                <div class="form-group">
                                    <label for="name" class="sr-only form-label">Nama lengkap</label>
                                    <input type="text" class="form-control" placeholder="Nama lengkap" name="name"
                                        value="{{ old('name') }}">
                                </div>
                                <div class="form-group">
                                    <label for="email" class="sr-only form-label">Email</label>
                                    <input type="email" class="form-control" placeholder="Email" name="email"
                                        value="{{ old('email') }}">
                                </div>
                                <div class="form-group">
                                    <label for="password" class="sr-only form-label">Password</label>
                                    <input type="password" id="password" class="form-control" placeholder="Password"
                                        name="password">
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation" class="sr-only form-label">Confirm Password</label>
                                    <input type="password" id="password_confirmation" class="form-control"
                                        placeholder="Confirm Password" name="password_confirmation">
                                </div>
                            </div>
                            <div class="form-actions d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1">Registrasi</button>
                                <a href="{{ '/' }}" class="btn btn-light-primary">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <a href="{{ route('login.index') }}">Sudah punya akun</a>
                |
                <a href="{{ route('password.request') }}">Lupa kata sandi</a>
            </div>
        </div>
    </div>
@endsection
