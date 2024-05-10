<?php

namespace App\Services;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthService
{
    /**
     * Log a user in
     *
     * @param array<string, string> $input
     * @throws ValidationException
     */
    public function loginOrFail(array $input): Authenticatable
    {
        Validator::make($input, [
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
            ],
            'password' => [
                'required',
                'string',
            ]
        ])->validate();

        if (!Auth::attempt([
            'email' => $input['email'],
            'password' => $input['password'],
        ])) {
            throw ValidationException::withMessages([
                'email' => [__('auth.failed')]
            ]);
        }
        $user = Auth::user();
        if (!$user->is_active)
            throw new ModelNotFoundException('User not found.');

        return $user;
    }
}
