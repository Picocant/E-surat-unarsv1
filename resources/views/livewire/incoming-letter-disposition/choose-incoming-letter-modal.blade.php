<div>
    <div class="form-group mb-3">
        <input wire:model.debounce.500ms="search" type="text" placeholder="Cari..." class="form-control">
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Nomor</th>
                    <th>Tanggal</th>
                    <th>Perihal</th>
                    <th>Asal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($incomingLetters as $incomingLetter)
                    <tr>
                        <td>{{ $incomingLetter->letter_number }}</td>
                        <td>{{ $incomingLetter->date->isoFormat('DD MMMM Y') }}</td>
                        <td>{{ $incomingLetter->regarding }}</td>
                        <td>{{ $incomingLetter->from }}</td>
                        <td>
                            @if ($include != null)
                                <a href="{{ route('incoming-letter-disposition.edit', ['incomingLetterDisposition' => $incomingLetterDisposition]) }}?incoming_letter_id={{ $incomingLetter->id }}"
                                    class="btn btn-sm btn-light-primary">Pilih</a>
                            @else
                                <a href="{{ route('incoming-letter-disposition.create') }}?incoming_letter_id={{ $incomingLetter->id }}"
                                    class="btn btn-sm btn-light-primary">Pilih</a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
