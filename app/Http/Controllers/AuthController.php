<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    protected $authService;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $result = $this->authService->register($request->validated());
        $message = __('messages.welcome');
        return response()->json([
            'message' => $message,
            'user' => new UserResource($result['user']),
            'access_token' => $result['access_token'],
        ]);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $result = $this->authService->login($request->validated());
        $message = __('messages.login');
        return response()->json([
            'message' => $message,
            'user' => new UserResource($result['user']),
            'access_token' => $result['access_token'],
        ]);
    }
}
