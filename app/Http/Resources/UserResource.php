<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    protected $token;
    public function withToken($token): self
    {
        $this->token = $token;
        return $this;
    }
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'username' => $this->username,
            'image' => $this->image,
            'token'=> $this->token,
        ];
    }
}
