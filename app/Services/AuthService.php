<?php

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Trait\Response;

class AuthService
{
    use Response;
    public function register(array $data)
    {
        $user = new User();
        $user->email = $data['email'];
        $user->username = $data['username'];
        $user->password = Hash::make($data['password']);

        if (isset($data['image'])) {
            $user->image = $data['image']->store('images', 'public');
        }

        $user->save();
        $token = $user->createToken('auth_token')->plainTextToken;
        $data = (new UserResource($user))->withToken($token);
        $massage = __('messages.register');

        return $this->success(
            data: $data,
            message: $massage,
            status: 200
        );
    }

    public function login(array $credentials)
    {
        $user = User::where('email', $credentials['email'])->first();
        if (!$user || Hash::check($credentials['password'], $user->password)) {
            return $this->failed(null, __('messages.invalid_credentials'));
        }
        Auth::login($user);
        $token = $user->createToken('user_token')->plainTextToken;
        $data = (new UserResource($user))->withToken($token);
        $massage = __('messages.login');
        return $this->success(
            data: $data,
            message: $massage,
            status: 200,
        );
    }
}

