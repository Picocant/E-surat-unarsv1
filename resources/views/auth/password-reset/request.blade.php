@extends('layouts.base')

@section('content')
    <div class="row">
        <div class="col-lg-5 mx-auto">
            <h2 class="text-center mb-4">Lupa Kata Sandi</h2>
            <div class="card mb-3">
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" method="post" action="{{ route('password.email') }}">
                            @csrf
                            <div class="form-body">
                                <div class="form-group">
                                    <label for="email" class="sr-only form-label">Link reset kata sandi akan dikirim ke
                                        alamat email kamu</label>
                                    <input type="email" class="form-control" placeholder="Email" name="email"
                                        value="{{ old('email') }}">
                                </div>
                            </div>
                            <div class="form-actions d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1">Kirim Link</button>
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
