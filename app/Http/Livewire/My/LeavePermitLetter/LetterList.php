<?php

namespace App\Http\Livewire\My\LeavePermitLetter;

use App\Events\Activity;
use App\Models\LeavePermitLetter;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LetterList extends Component
{
    public $leavePermitLetters;

    public function mount()
    {
        $user = User::with('leave_permit_letters')->find(Auth::id());

        $this->leavePermitLetters = $user->leave_permit_letters;
    }

    public function delete(LeavePermitLetter $leavePermitLetter)
    {
        if (!$leavePermitLetter->letter->waiting()) {
            $this->dispatchBrowserEvent('swal', [
                'type' => 'warning',
                'message' => 'Tidak dapat menghapus surat yang sudah ditolak atau diverifikasi'
            ]);
            return;
        }

        $leavePermitLetter->delete();

        Activity::dispatch('menghapus pengajuan surat izin cuti');

        $this->dispatchBrowserEvent('swal', [
            'type' => 'success',
            'message' => 'Surat izin cuti berhasil dihapus'
        ]);
        $this->mount();
    }

    public function edit(LeavePermitLetter $leavePermitLetter)
    {
        if (!$leavePermitLetter->letter->waiting()) {
            $this->dispatchBrowserEvent('swal', [
                'type' => 'warning',
                'message' => 'Tidak dapat memperbarui surat yang sudah ditolak atau diverifikasi'
            ]);
            return;
        }
        $this->emit('my:leave-permit-letter:edit', $leavePermitLetter);
    }

    public function render()
    {
        return view('livewire.my.leave-permit-letter.letter-list');
    }
}
