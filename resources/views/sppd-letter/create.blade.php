@extends('layouts.base')

@section('content')
    <h3 class="mb-4">Surat Perintah Perjalanan Dinas</h3>
    <div class="mb-3">
        <a href="{{ route('sppd-letter.index') }}" class="btn btn-sm btn-primary">Kembali</a>
    </div>
    <form action="{{ route('sppd-letter.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-lg-6">
                <h5 class="mb-3">Data Surat</h5>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="from_user_id" class="form-label">Pemberi Perintah</label>
                                <select class="form-control select2" name="from_user_id" id="from_user_id">
                                    @foreach ($users as $fromUser)
                                        <option {{ old('from_user_id') == $fromUser->id ? 'selected' : '' }}
                                            value="{{ $fromUser->id }}">{{ $fromUser->nip }} -
                                            {{ $fromUser->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="budget" class="form-label">Anggaran (Rp.)</label>
                                <input min="0" type="number" name="budget" id="budget" class="form-control"
                                    value="{{ old('budget') }}">
                            </div>
                            <div class="form-group">
                                <label for="start_date" class="form-label">Tanggal Mulai</label>
                                <input type="date" name="start_date" id="start_date" class="form-control"
                                    value="{{ old('start_date') }}">
                            </div>
                            <div class="form-group">
                                <label for="end_date" class="form-label">Tanggal Selesai</label>
                                <input type="date" name="end_date" id="end_date" class="form-control"
                                    value="{{ old('end_date') }}">
                            </div>
                            <div class="form-group">
                                <label for="destination" class="form-label">Untuk melakukan perjalanan ke</label>
                                <textarea name="destination" class="form-control" id="destination">{{ old('destination') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="purpose" class="form-label">Maksud Perjalanan</label>
                                <textarea name="purpose" class="form-control" id="purpose">{{ old('purpose') }}</textarea>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <h5 class="mb-3">Daftar Penerima Perintah</h5>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="datatable">
                                    <thead>
                                        <tr>
                                            <th>Pilih</th>
                                            <th>Nama</th>
                                            <th>Jabatan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $old = [];
                                            if ($a = old('recipient_ids')) {
                                                $old = $a;
                                            }
                                        @endphp
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>
                                                    <input value="{{ $user->id }}"
                                                        {{ in_array($user->id, $old) ? 'checked' : '' }} type="checkbox"
                                                        name="recipient_ids[]" id="{{ $user->id }}"
                                                        class="form-check">
                                                </td>
                                                <td>
                                                    {{ $user->name }}
                                                    <br>
                                                    <small>{{ $user->nip }}</small>
                                                </td>
                                                <td>{{ $user->position ? $user->position->name : '-' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
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
