<?php

namespace App\Providers;

use App\Events\Activity;
use App\Events\LetterCreated;
use App\Events\LetterRejected;
use App\Events\LetterVerified;
use App\Events\NewIncomingLetter;
use App\Events\UserDeleted;
use App\Events\UserManuallyCreated;
use App\Events\UserRegistered;
use App\Listeners\ActivityListener;
use App\Listeners\LetterCreatedListener;
use App\Listeners\LetterRejectedListener;
use App\Listeners\LetterVerifiedListener;
use App\Listeners\NewIncomingLetterListener;
use App\Listeners\PasswordResetListener;
use App\Listeners\UserDeletedListener;
use App\Listeners\UserManuallyCreatedListener;
use App\Listeners\UserRegisteredListener;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        PasswordReset::class => [
            PasswordResetListener::class
        ],
        UserRegistered::class => [
            UserRegisteredListener::class,
        ],
        UserManuallyCreated::class => [
            UserManuallyCreatedListener::class,
        ],
        UserDeleted::class => [
            UserDeletedListener::class
        ],
        NewIncomingLetter::class => [
            NewIncomingLetterListener::class
        ],
        LetterCreated::class => [
            LetterCreatedListener::class
        ],
        LetterVerified::class => [
            LetterVerifiedListener::class
        ],
        LetterRejected::class => [
            LetterRejectedListener::class
        ],
        Activity::class => [
            ActivityListener::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
