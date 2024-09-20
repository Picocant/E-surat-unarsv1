<?php

namespace App\Http\Livewire\My\LeavePermitLetter;

use App\Events\Activity;
use App\Events\LetterCreated;
use App\Models\LeavePermitLetter;
use App\Models\Letter;
use Livewire\Component;

class CreateForm extends Component
{
    public $startDate;
    public $endDate;
    public $reason;

    protected $rules = [
        'startDate' => ['required', 'date'],
        'endDate' => ['required', 'after_or_equal:startDate'],
        'reason' => ['required'],
    ];

    public function mount()
    {
        $this->startDate = '';
        $this->endDate = '';
        $this->reason = '';
    }

    public function save()
    {
        $this->validate();

        $leavePermitLetter = new LeavePermitLetter;
        $leavePermitLetter->user_id = auth()->id();
        $leavePermitLetter->regarding = 'Surat Izin Cuti';
        $leavePermitLetter->attachment = '-';
        $leavePermitLetter->start_date = $this->startDate;
        $leavePermitLetter->end_date = $this->endDate;
        $leavePermitLetter->reason = $this->reason;
        $leavePermitLetter->save();
        $leavePermitLetter->letter()->save(new Letter([
            'note' => 'Surat telah dibuat dan menunggu untuk diverifikasi'
        ]));

        LetterCreated::dispatch(LeavePermitLetter::class, $leavePermitLetter);

        Activity::dispatch('mengajukan surat izin cuti');

        return to_route('my.leave-permit-letter.index')->with('swal.success', 'Surat izin cuti berhasil dibuat');
    }

    public function render()
    {
        return view('livewire.my.leave-permit-letter.create-form');
    }
}
