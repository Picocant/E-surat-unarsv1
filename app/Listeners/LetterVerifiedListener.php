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
        $notifiables = User::where('role', User::ROLE_KEPALA_SEKOLAH)
            ->orWhere('role', User::ROLE_KEPALA_TU)
            ->orWhere('role', User::ROLE_STAF_TU)
            ->get();

        Notification::send($notifiables, new TransactionalLetterVerified($event->model, $event->letter));

        if ($event->model == LeavePermitLetter::class) {
            $event->letter->user->notify(new LeavePermitLetterVerified($event->letter));
        }
    }
}
