@extends('layouts.base')

@section('content')
    <h3 class="mb-4">Surat Izin Cuti</h3>
    <div class="mb-3">
        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
            data-bs-target="#create-leave-permit-letter-modal">
            Buat Surat Baru
        </button>
    </div>
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <livewire:my.leave-permit-letter.letter-list />
            </div>
        </div>
    </div>

    <x-modal modal-id="create-leave-permit-letter-modal" modal-title="Surat Izin Cuti Baru" modal-size="modal-md">
        <livewire:my.leave-permit-letter.create-form />
    </x-modal>
    <x-modal modal-id="edit-leave-permit-letter-modal" modal-title="Edit Surat Izin Cuti" modal-size="modal-md">
        <livewire:my.leave-permit-letter.edit-form />
    </x-modal>
@endsection
