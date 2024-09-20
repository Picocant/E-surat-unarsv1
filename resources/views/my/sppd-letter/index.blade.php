@extends('layouts.base')

@section('content')
    <h3 class="mb-4">Surat Perintah Perjalanan Dinas Anda</h3>
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="datatable">
                        <thead>
                            <tr>
                                <th>Nomor Surat</th>
                                <th>Pemberi Perintah</th>
                                <th>Perjalanan Ke</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sppdLetters as $sppdLetter)
                                <tr>
                                    <td>
                                        @if ($sppdLetter->letter->letter_number == null)
                                            <span class="badge bg-light-danger">Tidak ada</span>
                                        @else
                                            {{ $sppdLetter->letter->letter_number }}
                                        @endif
                                    </td>
                                    <td>{{ $sppdLetter->from->name }}</td>
                                    <td>{{ $sppdLetter->destination }}</td>
                                    <td>
                                        <a target="_blank"
                                            href="{{ route('my.sppd-letter.print', ['sppdLetter' => $sppdLetter]) }}"
                                            class="btn btn-sm btn-light-primary">Cetak</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
