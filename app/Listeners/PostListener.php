<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

use App\Models\User;
use App\Notifications\PostNotification;

class PostListener
{
    public function handle($event)
    {
        User::role('admin')->get()->except($event->post->user_id)
            ->each(function(User $user) use ($event) {
                Notification::send($user, new PostNotification($event->post));
            });
    }
}
