<?php

namespace App\Listeners;

use App\Events\LetterVerified;
use App\Models\LeavePermitLetter;
use App\Models\User;
use App\Notifications\LeavePermitLetterVerified;
use App\Notifications\Transactional\LetterVerified as TransactionalLetterVerified;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class LetterVerifiedListener
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\LetterVerified  $event
     * @return void
     */
    public function handle(LetterVerified $event)
    {
        $notifiables = User::where('role', User::ROLE_REKTOR)
            ->orWhere('role', User::ROLE_SUPERADMIN)
            ->orWhere('role', User::ROLE_BIRO1)
            ->get();

        Notification::send($notifiables, new TransactionalLetterVerified($event->model, $event->letter));

        if ($event->model == LeavePermitLetter::class) {
            $event->letter->user->notify(new LeavePermitLetterVerified($event->letter));
        }
    }
}
