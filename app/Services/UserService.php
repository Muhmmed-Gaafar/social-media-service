<?php



namespace App\Services;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserFollowed;
use App\Trait\Response;
use Illuminate\Http\JsonResponse;

class UserService
{
    use Response;

    public function followUser(User $followed): JsonResponse
    {
        $follower = Auth::id();
        if ($follower === $followed->id) {
            return $this->failed(
                data: null,
                message: __('messages.error_self'),
                status: 400
            );
        }
        $exists = Follow::where('follower_id', $follower)
            ->where('followed_id', $followed->id)
            ->exists();
        if ($exists) {
            return $this->failed(
                data: null,
                message: __('messages.already_followed'),
                status: 400
            );
        }
        $follow = Follow::create([
            'follower_id' => $follower,
            'followed_id' => $followed->id,
        ]);
        Mail::to($followed->email)->send(new UserFollowed(Auth::user(), $followed));
        // $followed->notify(new UserFollowedNotification(Auth::user()));
        return $this->success(
            data: $follow,
            message: __('messages.followed'),
            status: 200
        );
    }
}
