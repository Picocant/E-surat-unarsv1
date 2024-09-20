<div>
    @if ($notifications->count() > 0)
        <div class="mb-3">
            <button wire:click="markAllAsRead" class="btn btn-primary btn-sm">Tandai Semua Telah Dibaca</button>
            <button wire:click="deleteAll" class="btn btn-primary btn-sm">Hapus Semua</button>
        </div>
    @endif
    @forelse($notifications as $notification)
        @if ($notification->read_at == null)
            <div class="alert alert-secondary">
                <h6 class="fw-bold">
                    {{ $notification->data['title'] }}
                </h6>
                <p>{{ $notification->created_at }} ({{$notification->created_at->diffForHumans()}}) | <button type="button"
                        wire:click="markAsRead('{{ $notification->id }}')"
                        class="bg-transparent border-0 outline-none p-0">Tandai Telah
                        Dibaca</button></p>
                <p>{!! $notification->data['message'] !!}</p>
            </div>
        @else
            <div class="alert alert-light">
                <h6 class="fw-bold">
                    {{ $notification->data['title'] }}
                </h6>
                <p>{{ $notification->created_at }} ({{$notification->created_at->diffForHumans()}}) | <button type="button"
                        wire:click="delete('{{ $notification->id }}')"
                        class="bg-transparent border-0 outline-none p-0">Hapus</button></p>
                <p>{!! $notification->data['message'] !!}</p>
            </div>
        @endif
    @empty
        <div class="text-center">Belum ada notifikasi</div>
    @endforelse
</div>
