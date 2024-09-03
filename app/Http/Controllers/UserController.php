<?php

namespace App\Http\Controllers;

use App\Http\Requests\FollowRequest;
use App\Http\Resources\FollowResource;
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
        $followedUser = User::findOrFail($followedId);

        $result = $this->userService->followUser($followedUser);

        if (!$result['status']) {
            return response()->json([
                'message' => $result['message'],
            ], 400);
        }

        return response()->json([
            'message' => $result['message'],
            'follow' => new FollowResource($result['follow']),
        ], 201);
    }



}

