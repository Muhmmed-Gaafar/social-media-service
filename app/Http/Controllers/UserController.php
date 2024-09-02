<?php

namespace App\Http\Controllers;

use App\Http\Requests\FollowRequest;
use App\Http\Resources\FollowResource;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function follow(FollowRequest $request): JsonResponse
    {
        $followedId = $request->input('followed_id');
        $result = $this->userService->followUser($followedId);

        if (!$result['status']) {
            $message = __('messages.already_followed');
            return response()->json([
                'message' => $message,
            ], 400);
        }

        $message = __('messages.followed');
        return response()->json([
            'message' => $message,
            'follow' => new FollowResource($result['follow']),
        ], 201);
    }

}

