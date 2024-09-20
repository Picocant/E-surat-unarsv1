<?php

namespace App\Listeners;

use App\Events\Activity;
use App\Models\Activity as ModelsActivity;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class ActivityListener
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\Activity  $event
     * @return void
     */
    public function handle(Activity $event)
    {
        $description = $event->description;

        $activity = new ModelsActivity();
        $activity->user_id = Auth::id();
        $activity->description = $description;
        $activity->save();
    }
}
