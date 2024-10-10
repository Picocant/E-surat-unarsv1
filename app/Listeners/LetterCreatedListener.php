<?php

namespace App\Listeners;

use App\Events\LetterCreated;
use App\Models\User;
use App\Notifications\Transactional\LetterVerificationNotice;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class LetterCreatedListener
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\LetterCreated  $event
     * @return void
     */
    public function handle(LetterCreated $event)
    {
        $notifiables = User::where('role', User::ROLE_REKTOR)->get();

        Notification::send($notifiables, new LetterVerificationNotice($event->model, $event->letter));
    }
}
