<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthService
{
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
        return [
            'user' => $user,
            'access_token' => $token,
        ];
    }

    public function login(array $credentials)
    {
        $user = User::where('email', $credentials['email'])->first();
        if (!$user || Hash::check($credentials['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        Auth::login($user);
        $token = $user->createToken('user_token')->plainTextToken;
        return [
            'user' => $user,
            'access_token' => $token,
        ];
    }
}
