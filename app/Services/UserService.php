<?php
namespace App\Services;

use App\Mail\UserFollowed;
use App\Models\Follow;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserService
{
    public function followUser($followedId)
    {
        $follower = Auth::id();
        $exists = Follow::where('follower_id', $follower)
            ->where('followed_id', $followedId->id)
            ->exists();

        if ($exists) {
            $message = __('messages.already_followed');
            return ['status' => false, 'message' => $message];
        }
        $follow = Follow::create([
            'follower_id' => $follower,
            'followed_id' => $followedId->id,
        ]);
        Mail::to($followedId->email)->send(new UserFollowed(Auth::user(), $followedId));
        $message = __('messages.followed');
        return ['status' => true, 'message' => $message, 'follow' => $follow];
    }
}
