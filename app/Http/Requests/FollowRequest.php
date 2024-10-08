<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FollowRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'followed_id' => 'required|exists:users,id|integer',
        ];
    }
}
