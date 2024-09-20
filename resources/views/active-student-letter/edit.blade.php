@extends('layouts.base')

@section('content')
<div class="row">
    <div class="col-lg-6 mx-auto">
        <h3 class="mb-4">Edit Surat Keterangan Mahasiswa Aktif</h3>
        <div class="mb-3">
            <a href="{{ route('active-student-letter.index') }}" class="btn btn-sm btn-primary">Kembali</a>
        </div>
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    @if (sizeof($students) < 1) <div class="alert alert-light-warning mb-0" role="alert">
                        Harap <a href="{{ route('student.create') }}" class="alert-link">input data mahasiswa</a>
                        terlebih dahulu.
                </div>
                @else
                <form action="{{ route('active-student-letter.update', ['activeStudentLetter' => $activeStudentLetter]) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="student_id" class="form-label">Mahasiswa</label>
                        <select class="form-control select2" name="student_id" id="student_id">
                            @foreach ($students as $student)
                            <option {{ old('student_id', $activeStudentLetter->student_id) == $student->id ? 'selected' : '' }} value="{{ $student->id }}">{{ $student->student_number }} -
                                {{ $student->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="purpose" class="form-label">Keperluan</label>
                        <textarea name="purpose" class="form-control" id="purpose">{{ old('purpose', $activeStudentLetter->purpose) }}</textarea>
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