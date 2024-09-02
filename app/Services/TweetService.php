<?php

namespace App\Services;

use App\Models\Tweet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class TweetService
{
    public function createTweet(array $data): ?Tweet
    {
        return  Tweet::create([
            'user_id' => $data['user_id'],
            'content' => $data['tweet_text'],
        ]);
    }


    public function getTimeline()
    {
        return Tweet::with('user')->paginate(10);
    }
}

