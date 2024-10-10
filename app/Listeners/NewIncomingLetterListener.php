<?php

namespace App\Listeners;

use App\Events\NewIncomingLetter;
use App\Models\User;
use App\Notifications\Transactional\NewIncomingLetter as TransactionalNewIncomingLetter;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class NewIncomingLetterListener
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\NewIncomingLetter  $event
     * @return void
     */
    public function handle(NewIncomingLetter $event)
    {
        $incomingLetter = $event->incomingLetter;
        $notifiables = User::where('role', User::ROLE_REKTOR)->get();
        Notification::send($notifiables, new TransactionalNewIncomingLetter($incomingLetter));
    }
}
