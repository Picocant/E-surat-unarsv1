@extends('layouts.base')

@section('content')
    <h3 class="mb-4">Log Aktivitas Pengguna</h3>

    @if ($activities->count() > 0)
        <div class="mb-3">
            <form action="{{ route('system.activities.clear') }}" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-sm btn-primary"
                    onclick="return confirm('Bersihkan histori aktivitas pengguna?')">Bersihkan</button>
            </form>
        </div>
    @endif

    @forelse ($activities as $activity)
        <div class="mb-3">
            @if ($activity->user)
                {{ $activity->created_at }} - {{ $activity->user->name }} ({{ $activity->user->email }}) telah
                {{ $activity->description }}
            @else
                {{ $activity->created_at }} - <i>Deleted Account</i> telah {{ $activity->description }}
            @endif
        </div>
    @empty
        <div class="alert bg-light-warning" role="alert">
            Tidak ada aktivitas
        </div>
    @endforelse
    {{ $activities->links() }}
@endsection
