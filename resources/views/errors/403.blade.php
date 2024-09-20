@extends('layouts.error')

@section('content')
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="alert alert-light-danger" role="alert">
                <div class="text-center">
                    <h2>403</h2>
                    <h5>Forbidden Error</h5>
                    <p>Maaf anda tidak memiliki akses untuk resource ini</p>
                    <div class="mt-3">
                        <a href="{{ route('home.index') }}" class="btn btn-sm btn-light">Kembali Ke Beranda</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
