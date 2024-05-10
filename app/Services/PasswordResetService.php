<?php

namespace App\Services;

use App\Models\User;
use App\Traits\PasswordValidationRules;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class PasswordResetService // TODO: Testing
{
    use PasswordValidationRules;

    /**
     * Request a password change and send link via email.
     *
     * @param array $input
     * @return void
     * @throws ValidationException
     * @throws ModelNotFoundException
     */
    public function sendResetLink(array $input): void
    {
        Validator::make($input, [
            'email' => ['required', 'email'],
        ]);

        User::where('email', $input['email'])->firstOrFail();
        $response = Password::sendResetLink(Arr::only($input, 'email'));

        if ($response != Password::RESET_LINK_SENT)
            throw ValidationException::withMessages([
                'email' => $response
            ]);
    }

    /**
     * Validate and reset the user's forgotten password.
     *
     * @param array<string, string> $input
     * @throws ValidationException
     */
    public function reset(array $input): void
    {
        Validator::make($input, [
            'token' => 'required',
            'email' => ['required', 'email'],
            'password' => $this->passwordRules(),
        ])->validate();

        $response = Password::reset(
            Arr::only($input, ['email', 'password', 'password_confirmation', 'token']),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password),
                    'remember_token' => Str::random(60),
                ])->save();
            });

        if ($response != Password::PASSWORD_RESET)
            throw ValidationException::withMessages([
                'password' => $response,
            ]);
    }

}
