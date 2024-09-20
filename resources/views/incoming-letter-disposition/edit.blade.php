@extends('layouts.base')

@section('content')
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <h3 class="mb-4">Edit Disposisi Surat</h3>
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="alert alert-light-primary color-primary">
                            <div class="d-flex g-4 justify-content-between">
                                <span>Nomor Surat. {{ $incomingLetter->letter_number }}</span>
                                <a data-bs-toggle="modal" data-bs-target="#choose-incoming-letter" role="button" href="#"
                                    class="alert-link">Ubah</a>
                            </div>
                            <div>Tanggal. {{ $incomingLetter->date->isoFormat('DD MMMM Y') }}</div>
                            <div>Perihal. {{ $incomingLetter->regarding }}</div>
                            <div>Asal. {{ $incomingLetter->from }}</div>
                        </div>
                        <form
                            action="{{ route('incoming-letter-disposition.update', ['incomingLetterDisposition' => $incomingLetterDisposition]) }}?incoming_letter_id={{ $incomingLetter->id }}"
                            method="post">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="to" class="form-label">Tujuan</label>
                                <input type="text" class="form-control" name="to"
                                    value="{{ old('to', $incomingLetterDisposition->to) }}">
                            </div>
                            <div class="form-group">
                                <label for="type" class="form-label">Sifat</label>
                                <select class="form-select" id="type" name="type">
                                    @foreach ($types as $type)
                                        <option
                                            {{ old('type', $incomingLetterDisposition->type) === $type ? 'selected' : '' }}
                                            value="{{ $type }}">
                                            {{ $type }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="message" class="form-label">Pesan disposisi</label>
                                <textarea id="message" class="form-control"
                                    name="message">{{ old('message', $incomingLetterDisposition->message) }}</textarea>
                            </div>
                            <div class="mt-3 text-end">
                                <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-incoming-letter-disposition.choose-incoming-letter-modal
        include="{{ $incomingLetterDisposition->incoming_letter->id }}" />
@endsection
