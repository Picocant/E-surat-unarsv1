<div class="modal modal-borderless fade text-left" id="{{ $modalId }}" tabindex="-1"
    aria-labelledby="{{ $modalId }}-label" style="display: none;" aria-hidden="true" data-bs-backdrop="false">
    <div class="modal-dialog {{ $modalSize }} modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="{{ $modalId }}-label">{{ $modalTitle }}</h4>
                <button type="button" class="btn btn-sm btn-light-danger" data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-x">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
