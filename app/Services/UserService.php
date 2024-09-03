<?php
namespace App\Services;

use App\Mail\UserFollowed;
use App\Models\Follow;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserService
{
//    public function followUser($followedId)
//    {
//        $followerId = Auth::id();
//        $exists = Follow::where('follower_id', $followerId)
//            ->where('followed_id', $followedId)
//            ->exists();
//        if ($exists) {
//            return ['status' => false, 'message' => 'You are already following this user.'];
//        }
//        $follow = Follow::create([
//            'follower_id' => $followerId,
//            'followed_id' => $followedId,
//        ]);
//        return ['status' => true, 'message' => 'Successfully followed the user.', 'follow' => $follow];
//    }

    public function followUser(User $followedUser)
    {
        $follower = auth()->user();

        if ($follower->isFollowing($followedUser)) {
            return [
                'status' => false,
                'message' => __('messages.already_followed')
            ];
        }
        $follower->follow($followedUser);
        Mail::to($followedUser->email)->send(new UserFollowed($follower, $followedUser));
        return [
            'status' => true,
            'follow' => $followedUser,
            'message' => __('messages.followed')
        ];
    }
}
