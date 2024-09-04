<?php

namespace App\Http\Controllers;

use App\Http\Requests\TweetRequest;
use App\Services\TweetService;
use Illuminate\Http\JsonResponse;

class TweetController extends Controller
{
    protected $tweetService;
    public function __construct(TweetService $tweetService)
    {
        $this->tweetService = $tweetService;
    }
    public function timeline(): JsonResponse
    {
        return $this->tweetService->getTimeline();
    }
    public function store(TweetRequest $request): JsonResponse
    {
      return $this->tweetService->createTweet($request->validated());
    }
}



