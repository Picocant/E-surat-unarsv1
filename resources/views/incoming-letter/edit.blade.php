@extends('layouts.base')

@section('content')
    <h3 class="mb-4">Edit Data Surat Masuk</h3>
    <div class="mb-3">
        <a href="{{ route('incoming-letter.show', ['incomingLetter' => $incomingLetter]) }}"
            class="btn btn-sm btn-primary">Kembali</a>
    </div>
    <form action="{{ route('incoming-letter.update', ['incomingLetter' => $incomingLetter]) }}" method="post"
        enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-lg-7">
                <h5 class="mb-3">Data Surat</h5>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="letter_number" class="form-label">Nomor Surat</label>
                                <input type="text" class="form-control" name="letter_number"
                                    value="{{ old('letter_number', $incomingLetter->letter_number) }}">
                            </div>
                            <div class="form-group">
                                <label for="regarding" class="form-label">Perihal</label>
                                <input type="text" id="regarding" class="form-control" name="regarding"
                                    value="{{ old('regarding', $incomingLetter->regarding) }}">
                            </div>
                            <div class="form-group">
                                <label for="attachment" class="form-label">Lampiran</label>
                                <input type="text" id="attachment" class="form-control" name="attachment"
                                    value="{{ old('attachment', $incomingLetter->attachment) }}">
                            </div>
                            <div class="form-group">
                                <label for="from" class="form-label">Asal</label>
                                <input type="text" id="from" class="form-control" name="from"
                                    value="{{ old('from', $incomingLetter->from) }}">
                            </div>
                            <div class="form-group">
                                <label for="to" class="form-label">Tujuan</label>
                                <input type="text" id="to" class="form-control" name="to"
                                    value="{{ old('to', $incomingLetter->to) }}">
                            </div>
                            <div class="form-group">
                                <label for="date" class="form-label">Tanggal</label>
                                <input type="date" id="date" class="form-control" name="date"
                                    value="{{ old('date', $incomingLetter->date->format('Y-m-d')) }}">
                            </div>
                            <div class="form-group">
                                <label for="file" class="form-label">File Surat (pdf)</label>
                                <input type="file" id="file" class="form-control" name="file">
                            </div>
                            <div class="mt-3 text-end">
                                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <h5 class="mb-3">Kategori</h5>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            @foreach ($incomingLetterCategories as $incomingLetterCategory)
                                <div class="form-check">
                                    <input
                                        {{ old('incoming_letter_category_id', $incomingLetter->incoming_letter_category_id) == $incomingLetterCategory->id ? 'checked' : '' }}
                                        value="{{ $incomingLetterCategory->id }}" class="form-check-input" type="radio"
                                        name="incoming_letter_category_id" id="category-{{ $incomingLetterCategory->id }}">
                                    <label class="form-check-label" for="category-{{ $incomingLetterCategory->id }}">
                                        {{ $incomingLetterCategory->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
