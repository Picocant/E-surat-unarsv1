@extends('layouts.base')

@section('content')
<div class="row">
    <div class="col-lg-6 mx-auto">
        <h3 class="mb-4">Edit Surat Keterangan Pindah Universitas</h3>
        <div class="mb-3">
            <a href="{{ route('school-transfer-letter.show', ['schoolTransferLetter' => $schoolTransferLetter]) }}" class="btn btn-sm btn-primary">Kembali</a>
        </div>
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    @if (sizeof($students) < 1) <div class="alert alert-light-warning mb-0" role="alert">
                        Harap <a href="{{ route('student.create') }}" class="alert-link">input data mahasiswa</a>
                        terlebih dahulu.
                </div>
                @else
                <form action="{{ route('school-transfer-letter.update', ['schoolTransferLetter' => $schoolTransferLetter]) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="student_id" class="form-label">Mahasiswa</label>
                        <select class="form-control select2" name="student_id" id="student_id">
                            @foreach ($students as $student)
                            <option {{ old('student_id', $schoolTransferLetter->student_id) == $student->id ? 'selected' : '' }} value="{{ $student->id }}">{{ $student->student_number }} -
                                {{ $student->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="new_school" class="form-label">Universitas Baru</label>
                        <input type="text" name="new_school" id="new_school" class="form-control" value="{{ old('new_school', $schoolTransferLetter->new_school) }}">
                    </div>
                    <div class="form-group">
                        <label for="reason" class="form-label">Alasan Pindah</label>
                        <textarea name="reason" class="form-control" id="reason">{{ old('reason', $schoolTransferLetter->reason) }}</textarea>
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