<?php

namespace App\Services;

use App\Http\Resources\TweetResource;
use App\Models\Tweet;
use App\Trait\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class TweetService
{
    use Response;
    public function createTweet(array $data): JsonResponse
    {
        $tweet = Tweet::create([
            'user_id' => Auth::id(),
            'tweet_text' => $data['tweet_text'],
        ]);
        $message = __('messages.tweet_created');
        $data = new TweetResource($tweet);
        return $this->success(
            data: $data,
            message: $message,
            status: 200
        );
    }
    public function getTimeline(): JsonResponse
    {
        $user = Auth::user();
        if ($user) {
            $followerIds = $user->follows()->pluck('followed_id');
            $tweets = Tweet::with('user')
                ->whereIn('user_id', $followerIds)
                ->orWhere('user_id', $user->id)
                ->paginate(10);
        } else {
            $message = __('messages.you_not_authenticated');
        }
        $message = __('messages.all_tweets');
        return $this->success(
            data: $tweets,
            message: $message,
            status: 200
        );
    }
}


