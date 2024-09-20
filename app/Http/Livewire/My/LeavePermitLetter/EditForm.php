<?php

namespace App\Http\Livewire\My\LeavePermitLetter;

use App\Events\Activity;
use App\Models\LeavePermitLetter;
use Livewire\Component;

class EditForm extends Component
{
    public $edit;
    public $startDate;
    public $endDate;
    public $reason;

    protected $rules = [
        'startDate' => ['required', 'date'],
        'endDate' => ['required', 'after_or_equal:startDate'],
        'reason' => ['required'],
    ];

    protected $listeners = [
        'my:leave-permit-letter:edit' => 'edit',
    ];

    public function edit(LeavePermitLetter $leavePermitLetter)
    {
        $this->edit = $leavePermitLetter;
        $this->startDate = $leavePermitLetter->start_date->format('Y-m-d');
        $this->endDate = $leavePermitLetter->end_date->format('Y-m-d');
        $this->reason = $leavePermitLetter->reason;
    }

    public function update(LeavePermitLetter $leavePermitLetter)
    {
        $this->validate();

        $leavePermitLetter->start_date = $this->startDate;
        $leavePermitLetter->end_date = $this->endDate;
        $leavePermitLetter->reason = $this->reason;
        $leavePermitLetter->save();

        Activity::dispatch('memperbarui pengajuan surat izin cuti');

        return to_route('my.leave-permit-letter.index')->with('swal.success', 'Surat izin cuti berhasil diperbarui');
    }

    public function render()
    {
        return view('livewire.my.leave-permit-letter.edit-form');
    }
}
