<?php

namespace App\Listeners;

use App\Events\UserDeleted;
use App\Models\User;
use App\Notifications\AccountDeletedNotice;
use App\Notifications\Transactional\UserDeleted as TransactionalUserDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class UserDeletedListener
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\UserDeleted  $event
     * @return void
     */
    public function handle(UserDeleted $event)
    {
        // send notification to deleted user
        $event->deletedUser->notify(new AccountDeletedNotice());

        // send notification to Kepala TU role
        $users = User::where('role', User::ROLE_KEPALA_TU)->get();
        Notification::send($users, new TransactionalUserDeleted($event->deletedUser));
    }
}
