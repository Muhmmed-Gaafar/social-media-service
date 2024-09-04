<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserFollowedNotification extends Notification
{
    use Queueable;

    protected $follower;

    public function __construct($follower)
    {
        $this->follower = $follower;
    }

    public function via($notifiable)
    {
        return ['broadcast'];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'message' => "{$this->follower->name} has followed you.",
            'follower_id' => $this->follower->id,
        ]);
    }
    public function toArray($notifiable)
    {
        return [
            'message' => "{$this->follower->name} has followed you.",
            'follower_id' => $this->follower->id,
        ];
    }
}

