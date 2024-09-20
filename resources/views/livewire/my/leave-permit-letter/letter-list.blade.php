<div class="table-responsive">
    <table class="table" wire:ignore.self>
        <thead>
            <tr>
                <th>Nomor Surat</th>
                <th>Tanggal</th>
                <th>Tanggal Cuti</th>
                <th>Alasan Cuti</th>
                <th>Status</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($leavePermitLetters as $leavePermitLetter)
                <tr>
                    <td>
                        @if ($leavePermitLetter->letter->letter_number == null)
                            <span class="badge bg-light-danger">Tidak ada</span>
                        @else
                            {{ $leavePermitLetter->letter->letter_number }}
                        @endif
                    </td>
                    <td>{{ $leavePermitLetter->letter->created_at->isoFormat('DD MMMM Y') }}</td>
                    <td>
                        @if ($leavePermitLetter->start_date == $leavePermitLetter->end_date)
                            {{ $leavePermitLetter->start_date->isoFormat('DD MMMM Y') }}
                        @else
                            {{ $leavePermitLetter->start_date->isoFormat('DD MMMM Y') }}
                            s.d
                            {{ $leavePermitLetter->end_date->isoFormat('DD MMMM Y') }}
                        @endif
                    </td>
                    <td>{{ $leavePermitLetter->reason }}</td>
                    <td>
                        @if ($leavePermitLetter->letter->verified())
                        <span class="badge bg-light-primary">Diverifikasi</span>
                        @elseif ($leavePermitLetter->letter->rejected())
                        <span class="badge bg-light-danger">Ditolak</span>
                        @elseif ($leavePermitLetter->letter->waiting())
                        <span class="badge bg-light-warning">Menunggu Verifikasi</span>
                        @endif
                    </td>
                    <td>{{ $leavePermitLetter->letter->note }}</td>
                    <td nowrap>
                        @if ($leavePermitLetter->letter->verified())
                            <a target="_blank"
                                href="{{ route('my.leave-permit-letter.print', ['leavePermitLetter' => $leavePermitLetter]) }}"
                                class="btn btn-sm btn-light-primary">Cetak</a>
                        @else
                            @if ($leavePermitLetter->letter->waiting())
                                <button type="button" data-bs-toggle="modal"
                                    data-bs-target="#edit-leave-permit-letter-modal"
                                    wire:click="edit({{ $leavePermitLetter }})"
                                    class="btn btn-sm btn-light-primary">Edit</button>
                                <button onclick="return confirm('Hapus surat ini?')" type="button"
                                    wire:click="delete({{ $leavePermitLetter }})"
                                    class="btn btn-sm btn-light-danger">Hapus</button>
                            @else
                                -
                            @endif
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="text-center" colspan="6">Belum ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
