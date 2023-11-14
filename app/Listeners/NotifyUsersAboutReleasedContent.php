<?php

namespace App\Listeners;

use App\Events\ContentReleased;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyUsersAboutReleasedContent implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ContentReleased $event): void
    {
        //
    }
}
