@extends('layouts.base')

@section('content')
    <div class="row">
        <div class="col-lg-5 mx-auto">
            <h2 class="text-center mb-4">Atur Ulang Kata Sandi</h2>
            <div class="card mb-3">
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" method="post" action="{{ route('password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <input type="hidden" name="email" value="{{ request('email') }}">
                            <div class="form-body">
                                <div class="form-group">
                                    <label for="password" class="sr-only form-label">New Password</label>
                                    <input type="password" id="password" class="form-control" placeholder="Password"
                                        name="password">
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation" class="sr-only form-label">Confirm New
                                        Password</label>
                                    <input type="password" id="password_confirmation" class="form-control"
                                        placeholder="Confirm Password" name="password_confirmation">
                                </div>
                            </div>
                            <div class="form-actions d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1">Simpan</button>
                                <a href="{{ route('login.index') }}" class="btn btn-light-primary">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <a href="{{ route('register.index') }}">Belum punya akun</a>
            </div>
        </div>
    </div>
@endsection
