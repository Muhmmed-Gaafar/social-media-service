<?php
namespace App\Services;

use App\Models\Follow;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function followUser($followedId)
    {
        $followerId = Auth::id();
        $exists = Follow::where('follower_id', $followerId)
            ->where('followed_id', $followedId)
            ->exists();
        if ($exists) {
            return ['status' => false, 'message' => 'You are already following this user.'];
        }
        $follow = Follow::create([
            'follower_id' => $followerId,
            'followed_id' => $followedId,
        ]);
        return ['status' => true, 'message' => 'Successfully followed the user.', 'follow' => $follow];
    }
}
