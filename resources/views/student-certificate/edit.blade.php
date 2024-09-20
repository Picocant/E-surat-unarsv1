@extends('layouts.base')

@section('content')
<div class="row">
    <div class="col-lg-6 mx-auto">
        <h3 class="mb-4">Edit Data Arsip Ijazah Mahasiswa</h3>
        <div class="mb-3">
            <a href="{{ route('student-certificate.show', ['studentCertificate' => $studentCertificate]) }}" class="btn btn-sm btn-primary">Kembali</a>
        </div>
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    @if (sizeof($students) < 1) <div class="alert alert-light-warning mb-0" role="alert">
                        Data mahasiswa kosong atau seluruh ijazah mahasiswa sudah ditambahkan, Harap <a href="{{ route('student.create') }}" class="alert-link">input data
                            siswa</a> terlebih dahulu.
                </div>
                @else
                <form action="{{ route('student-certificate.update', ['studentCertificate' => $studentCertificate]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="student_id" class="form-label">Mahasiswa</label>
                        <select class="form-control select2" name="student_id" id="student_id">
                            @foreach ($students as $student)
                            <option {{ old('student_id', $studentCertificate->student_id) == $student->id ? 'selected' : '' }} value="{{ $student->id }}">{{ $student->student_number }} -
                                {{ $student->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="number" class="form-label">Nomor Ijazah</label>
                        <input type="text" name="number" id="number" class="form-control" value="{{ old('number', $studentCertificate->number) }}">
                    </div>
                    <div class="form-group">
                        <label for="date" class="form-label">Tanggal</label>
                        <input type="date" name="date" id="date" class="form-control" value="{{ old('date', $studentCertificate->date->format('Y-m-d')) }}">
                    </div>
                    <div class="form-group">
                        <label for="academic_year" class="form-label">Tahun Ajaran</label>
                        <input placeholder="Contoh format: 2021/2022" type="text" name="academic_year" id="academic_year" class="form-control" value="{{ old('academic_year', $studentCertificate->academic_year) }}">
                    </div>
                    <div class="form-group">
                        <label for="file" class="form-label">File Ijazah (pdf, kosongkan jika tidak
                            mengupdate file)</label>
                        <input type="file" name="file" id="file" class="form-control">
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('script')
<script defer>
    $(document).ready(() => {
        $('.select2').select2({
            width: '100%'
        })
    })
</script>
@endsection