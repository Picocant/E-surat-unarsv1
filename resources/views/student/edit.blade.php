@extends('layouts.base')

@section('content')
<div class="row">
    <div class="col-lg-6 mx-auto">
        <h3 class="mb-4">Edit Data Mahasiswa</h3>
        <div class="mb-3">
            <a href="{{ route('student.show', ['student' => $student]) }}" class="btn btn-sm btn-primary">Kembali</a>
        </div>
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <form action="{{ route('student.update', ['student' => $student]) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="name" class="form-label">Nama Mahasiswa</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $student->name) }}">
                        </div>
                        <div class="form-group">
                            <label for="student_number" class="form-label">Nomor Induk Mahasiswa</label>
                            <input type="text" name="student_number" id="student_number" class="form-control" value="{{ old('student_number', $student->student_number) }}">
                        </div>
                        <div class="form-group">
                            <label for="date_of_bird" class="form-label">Tanggal Lahir</label>
                            <input type="date" name="date_of_bird" id="date_of_bird" class="form-control" value="{{ old('date_of_bird', $student->date_of_bird->format('Y-m-d')) }}">
                        </div>
                        <div class="form-group">
                            <label for="gender" class="form-label">Jenis Kelamin</label>
                            <select class="form-control" name="gender" id="gender">
                                @foreach ($genders as $gender)
                                <option {{ old('gender', $student->gender) == $gender ? 'selected' : '' }} value="{{ $gender }}">{{ $gender }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="address" class="form-label">Alamat</label>
                            <textarea name="address" id="address" class="form-control">{{ old('address', $student->address) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="father" class="form-label">Nama Ayah</label>
                            <input type="text" name="father" id="father" class="form-control" value="{{ old('father', $student->father) }}">
                        </div>
                        <div class="form-group">
                            <label for="mother" class="form-label">Nama Ibu</label>
                            <input type="text" name="mother" id="mother" class="form-control" value="{{ old('mother', $student->mother) }}">
                        </div>
                        <div class="form-group">
                            <label for="guardian" class="form-label">Nama wali (tidak wajib)</label>
                            <input type="text" name="guardian" id="guardian" class="form-control" value="{{ old('guardian', $student->guardian) }}">
                        </div>
                        <div class="form-group">
                            <label for="fakultas" class="form-label">Nama Fakultas</label>
                            <input type="text" name="fakultas" id="fakultas" class="form-control" value="{{ old('fakultas', $student->fakultas) }}">
                        </div>
                        <div class="form-group">
                            <label for="prodi" class="form-label">Nama Prodi</label>
                            <input type="text" name="prodi" id="prodi" class="form-control" value="{{ old('prodi', $student->prodi) }}">
                        </div>
                        <div class="form-group">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control" name="status" id="status">
                                @foreach ($status as $status)
                                <option {{ old('status', $student->status) == $status ? 'selected' : '' }} value="{{ $status }}">{{ $status }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection