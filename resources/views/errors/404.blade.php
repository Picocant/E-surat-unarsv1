@extends('layouts.error')

@section('content')
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="alert alert-light-danger" role="alert">
                <div class="text-center">
                    <h2>404</h2>
                    <h5>Page Not Found</h5>
                    <p>Maaf, halaman yang anda cari tidak ditemukan</p>
                    <div class="mt-3">
                        <a href="{{ route('home.index') }}" class="btn btn-sm btn-light">Kembali Ke Beranda</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
