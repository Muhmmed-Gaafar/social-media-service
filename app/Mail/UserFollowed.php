<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserFollowed extends Mailable
{
    use Queueable, SerializesModels;

    public $follower;
    public $followed;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($follower, $followed)
    {
        $this->follower = $follower;
        $this->followed = $followed;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('You have a new follower!')
            ->view('emails.user_followed')
            ->with([
                'followerName' => $this->follower->name,
                'followedName' => $this->followed->name,
            ]);
    }
}

