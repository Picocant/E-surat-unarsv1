@extends('layouts.base')

@section('content')
    <div class="row">
        <div class="col-lg-5 mx-auto">
            <h2 class="text-center mb-4">Silahkan Login</h2>
            <div class="card mb-3">
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" method="post" action="{{ route('login.attempt') }}">
                            @csrf
                            <div class="form-body">
                                <div class="form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" placeholder="Email" name="email"
                                        value="{{ old('email') }}">
                                </div>
                                <div class="form-group">
                                    <label for="password" class="form-label">Kata Sandi</label>
                                    <input type="password" id="password" class="form-control" placeholder="Kata sandi"
                                        name="password">
                                </div>
                            </div>
                            <div class="form-actions d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1">Login</button>
                                <a href="{{ '/' }}" class="btn btn-light-primary">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <a href="{{ route('register.index') }}">Belum punya akun</a>
                |
                <a href="{{ route('password.request') }}">Lupa kata sandi</a>
            </div>
        </div>
    </div>
@endsection
