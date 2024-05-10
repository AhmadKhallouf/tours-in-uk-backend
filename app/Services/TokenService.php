<?php

namespace App\Services;

use Illuminate\Contracts\Auth\Authenticatable;

class TokenService
{
    public function create(Authenticatable $user)
    {
        return $user->createToken('auth-token')->plainTextToken;
    }

    public function revoke(Authenticatable $user): void
    {
        $user->currentAccessToken()->delete();
    }
}
