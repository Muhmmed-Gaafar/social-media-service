<?php

namespace App\Http\Controllers;

use App\Http\Requests\TweetRequest;
use App\Models\Tweet;
use App\Services\TweetService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class TweetController extends Controller
{
    protected $tweetService;

    public function __construct(TweetService $tweetService)
    {
        $this->tweetService = $tweetService;
    }

    public function timeline(): JsonResponse
    {
        $tweets = $this->tweetService->getTimeline();
        $message =__('messages.all_tweets');
        return response()->json([
            'message' => $message,
            'tweets' => $tweets
        ], 200);
    }

    public function store(TweetRequest $request): JsonResponse
    {
        $tweet = Tweet::create([
            'user_id' => Auth::id(),
            'tweet_text' => $request->tweet_text,
        ]);
        return response()->json([
            'message' => __('messages.tweet_created'),
            'tweet' => $tweet
        ], 201);
    }

}


