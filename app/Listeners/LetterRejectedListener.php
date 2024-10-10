<?php

namespace App\Listeners;

use App\Events\LetterRejected;
use App\Models\LeavePermitLetter;
use App\Models\User;
use App\Notifications\LeavePermitLetterRejected;
use App\Notifications\Transactional\LetterRejected as TransactionalLetterRejected;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class LetterRejectedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\LetterRejected  $event
     * @return void
     */
    public function handle(LetterRejected $event)
    {
        $notifiables = User::where('role', User::ROLE_REKTOR)
            ->orWhere('role', User::ROLE_SUPERADMIN)
            ->orWhere('role', User::ROLE_BIRO1)
            ->get();

        Notification::send($notifiables, new TransactionalLetterRejected($event->model, $event->letter));

        if ($event->model == LeavePermitLetter::class) {
            $event->letter->user->notify(new LeavePermitLetterRejected($event->letter));
        }
    }
}
