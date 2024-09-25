@extends('layouts.base')

@section('content')
<div class="row">
    <div class="col-lg-6 mx-auto">
        <h3 class="mb-4">Detail Data Mahasiswa</h3>
        <div class="mb-3">
            <a href="{{ route('student.index') }}" class="btn btn-sm btn-primary">Kembali</a>
            @if (can('update-student'))
            <a href="{{ route('student.edit', ['student' => $student]) }}" class="btn btn-sm btn-primary">Edit</a>
            @endif
            @if (can('delete-student'))
            <form method="POST" action="{{ route('student.destroy', ['student' => $student]) }}" class="d-inline">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data Mahasiswa?')">Hapus</button>
            </form>
            @endif
        </div>
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td>{{ $student->name }}</td>
                        </tr>
                        <tr>
                            <td>Nomor Induk Mahasiswa</td>
                            <td>:</td>
                            <td>{{ $student->student_number }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Lahir</td>
                            <td>:</td>
                            <td>{{ $student->date_of_bird->isoFormat('DD MMMM Y') }}</td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>:</td>
                            <td>{{ $student->gender }}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td>{{ $student->address }}</td>
                        </tr>
                        <tr>
                            <td>Nama Ayah</td>
                            <td>:</td>
                            <td>{{ $student->father }}</td>
                        </tr>
                        <tr>
                            <td>Nama Ibu</td>
                            <td>:</td>
                            <td>{{ $student->mother }}</td>
                        </tr>
                        <tr>
                            <td>Nama Wali</td>
                            <td>:</td>
                            <td>{{ $student->guardian }}</td>
                        </tr>
                        <tr>
                            <td>Fakultas</td>
                            <td>:</td>
                            <td>{{ $student->fakultas }}</td>
                        </tr>
                        <tr>
                            <td>Prodi</td>
                            <td>:</td>
                            <td>{{ $student->fakultas }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection