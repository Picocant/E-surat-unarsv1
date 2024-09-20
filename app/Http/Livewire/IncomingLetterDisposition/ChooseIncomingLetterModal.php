<?php

namespace App\Http\Livewire\IncomingLetterDisposition;

use App\Models\IncomingLetter;
use App\Models\IncomingLetterDisposition;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class ChooseIncomingLetterModal extends Component
{
    public $incomingLetters;
    public $search = '';
    public $include = null;
    public $incomingLetterDisposition;

    public function mount()
    {
        $this->incomingLetters = $this->getIncomingLetter();
        $this->incomingLetterDisposition = Route::current()->parameter('incomingLetterDisposition');
    }

    public function updatedSearch()
    {
        $this->incomingLetters = $this->getIncomingLetter();
    }

    public function render()
    {
        if ($this->include != null) {
            return view('livewire.incoming-letter-disposition.choose-incoming-letter-modal', [
                'incomingLetterDisposition' => $this->incomingLetterDisposition
            ]);
        }
        return view('livewire.incoming-letter-disposition.choose-incoming-letter-modal');
    }

    private function getIncomingLetter()
    {
        $incomingLetters = IncomingLetter::doesntHave('incoming_letter_disposition');
        if ($this->include != null) {
            $incomingLetters->orWhereHas('incoming_letter_disposition', function (Builder $builder) {
                $builder->where('incoming_letter_id', $this->include);
            });
        }
        if ($this->search != '') {
            $incomingLetters
                ->where('letter_number', 'like', "%$this->search%")
                ->orWhere('regarding', 'like', "%$this->search%")
                ->orWhere('from', 'like', "%$this->search%");
        }

        return $incomingLetters->orderBy('created_at', 'DESC')->get();
    }
}
