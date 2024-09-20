<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Models\User;
use App\Notifications\RegistrationSuccess;
use App\Notifications\Transactional\UserRegistered as TransactionalUserRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class UserRegisteredListener
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        // send notification to new user
        $event->user->notify(new RegistrationSuccess());

        // send notification to Kepala TU role
        $users = User::where('role', User::ROLE_KEPALA_TU)->get();
        Notification::send($users, new TransactionalUserRegistered($event->user));
    }
}
