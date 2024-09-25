@extends('layouts.base')

@section('content')
<div class="row">
    <div class="col-lg-6 mx-auto">
        <h3 class="mb-4">Edit Surat Keterangan Pindah Prodi</h3>
        <div class="mb-3">
            <a href="{{ route('pindah-prodi.show', ['pindahprodi' => $pindahProdi]) }}" class="btn btn-sm btn-primary">Kembali</a>
        </div>
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    @if (sizeof($students) < 1) <div class="alert alert-light-warning mb-0" role="alert">
                        Harap <a href="{{ route('student.create') }}" class="alert-link">input data mahasiswa</a>
                        terlebih dahulu.
                </div>
                @else
                <form action="{{ route('pindah-prodi.update', ['pindahprodi' => $pindahProdi]) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="student_id" class="form-label">Mahasiswa</label>
                        <select class="form-control select2" name="student_id" id="student_id">
                            @foreach ($students as $student)
                            <option {{ old('student_id', $pindahProdi->student_id) == $student->id ? 'selected' : '' }} value="{{ $student->id }}">{{ $student->student_number }} -
                                {{ $student->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="new_prodi" class="form-label">Prodi Baru</label>
                        <input type="text" name="new_prodi" id="new_prodi" class="form-control" value="{{ old('new_prodi', $pindahProdi->new_prodi) }}">
                    </div>
                    <div class="form-group">
                        <label for="reason" class="form-label">Alasan Pindah</label>
                        <textarea name="reason" class="form-control" id="reason">{{ old('reason', $pindahProdi->reason) }}</textarea>
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