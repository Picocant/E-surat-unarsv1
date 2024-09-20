<div>
    <form wire:submit.prevent="save">
        <div class="form-group">
            <label for="start_date" class="form-label">Tanggal Mulai Cuti</label>
            <input wire:model.defer="startDate" type="date" id="start_date" class="form-control"
                value="{{ $startDate }}">
            @error('startDate')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="end_date" class="form-label">Tanggal Selesai Cuti</label>
            <input wire:model.defer="endDate" type="date" id="end_date" class="form-control"
                value="{{ $endDate }}">
            @error('endDate')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="reason" class="form-label">Alasan Cuti</label>
            <textarea wire:model.defer="reason" class="form-control" id="reason">{{ $reason }}</textarea>
            @error('reason')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="text-end">
            <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
        </div>
    </form>
</div>
