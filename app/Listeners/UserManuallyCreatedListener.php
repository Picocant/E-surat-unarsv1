<?php

namespace App\Listeners;

use App\Events\UserManuallyCreated;
use App\Notifications\PasswordUpdateRequired;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserManuallyCreatedListener
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\UserManuallyCreated  $event
     * @return void
     */
    public function handle(UserManuallyCreated $event)
    {
        $event->user->notify(new PasswordUpdateRequired($event->randomPassword));
    }
}
