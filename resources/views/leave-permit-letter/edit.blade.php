@extends('layouts.base')

@section('content')
<div class="row">
    <div class="col-lg-6 mx-auto">
        <h3 class="mb-4">Edit Surat Izin Cuti</h3>
        <div class="mb-3">
            <a href="{{ route('leave-permit-letter.show', ['leavePermitLetter' => $leavePermitLetter]) }}" class="btn btn-sm btn-primary">Kembali</a>
        </div>
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <form action="{{ route('leave-permit-letter.update', ['leavePermitLetter' => $leavePermitLetter]) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="user_id" class="form-label">User/Pegawai Universitas</label>
                            <select class="form-control select2" name="user_id" id="user_id">
                                @foreach ($users as $user)
                                <option {{ old('user_id', $leavePermitLetter->user_id) == $user->id ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->nip }} -
                                    {{ $user->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="regarding" class="form-label">Perihal</label>
                            <input type="text" id="regarding" class="form-control" name="regarding" value="{{ old('regarding', $leavePermitLetter->regarding) }}">
                        </div>
                        <div class="form-group">
                            <label for="attachment" class="form-label">Lampiran</label>
                            <input type="text" id="attachment" class="form-control" name="attachment" value="{{ old('attachment', $leavePermitLetter->attachment) }}">
                        </div>
                        <div class="form-group">
                            <label for="start_date" class="form-label">Tanggal Mulai Cuti</label>
                            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date', $leavePermitLetter->start_date->format('Y-m-d')) }}">
                        </div>
                        <div class="form-group">
                            <label for="end_date" class="form-label">Tanggal Selesai Cuti</label>
                            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date', $leavePermitLetter->end_date->format('Y-m-d')) }}">
                        </div>
                        <div class="form-group">
                            <label for="reason" class="form-label">Alasan Cuti</label>
                            <textarea name="reason" class="form-control" id="reason">{{ old('reason', $leavePermitLetter->reason) }}</textarea>
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

@section('script')
<script defer>
    $(document).ready(() => {
        $('.select2').select2({
            width: '100%'
        })
    })
</script>
@endsection