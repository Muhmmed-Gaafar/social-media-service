<?php
namespace App\Services;

use App\Mail\UserFollowed;
use App\Models\Follow;
use App\Models\User;
use App\Notifications\UserFollowedNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserService
{
    public function followUser($followed)
    {
        $follower = Auth::id();
        if ($follower === $followed) {
            return [
                    'status' => false,
                    'message' => __('messages.error_self'),
            ];
        }
        $exists = Follow::where('follower_id', $follower)
            ->where('followed_id', $followed->id)
            ->exists();

//        if ($exists) {
//            $message = __('messages.already_followed');
//            return ['status' => false, 'message' => $message];
//        }
        $follow = Follow::create([
            'follower_id' => $follower,
            'followed_id' => $followed->id,
        ]);
        Mail::to($followed->email)->send(new UserFollowed(Auth::user(), $followed));

        $followed->notify(new UserFollowedNotification(Auth::user()));
        $message = __('messages.followed');
        return ['status' => true, 'message' => $message, 'follow' => $follow];
    }
}
