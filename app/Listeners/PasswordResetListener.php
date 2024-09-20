<?php

namespace App\Listeners;

use App\Notifications\PasswordChanged;
use Illuminate\Auth\Events\PasswordReset;

class PasswordResetListener
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\PasswordReset  $event
     * @return void
     */
    public function handle(PasswordReset $event)
    {
        $event->user->notify(new PasswordChanged());
    }
}
