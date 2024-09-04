<?php

namespace App\Http\Controllers;

use App\Http\Requests\FollowRequest;
use App\Models\User;
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
        $followedUser = User::find($followedId);
        if (!$followedUser) {
            return response()->json([
                'status' => 404,
                'message' => __('messages.user_not_found'),
            ], 404);
        }
        return $this->userService->followUser($followedUser);
    }
}

