<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\PermisoNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class PermisoListener
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
    public function handle(object $event): void
    {
        User::where('last_name', 'Latinfarma')
            ->each(function (User $user) use ($event) {
                Notification::send($user, new PermisoNotification($event->permiso));
            });
    }
}