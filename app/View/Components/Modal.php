<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Modal extends Component
{
    public string $modalId = '';
    public string $modalTitle = 'Modal Title';
    public string $modalSize = '';
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $modalId, string $modalTitle, string $modalSize)
    {
        $this->modalId = $modalId;
        $this->modalTitle = $modalTitle;
        $this->modalSize = $modalSize;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal');
    }
}
