<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class OtpService
{
    /**
     * Verify that OTP matches
     *
     * @throws ValidationException
     */
    public function verifyOrFail(string $topic, string $arg, $code): string
    {
        $storedCode = Cache::get($topic . '_code_' . $arg);

        if ($code != $storedCode) {
            throw ValidationException::withMessages([
                'verification_code' => __('The provided verification code does not match.'),
            ]);
        }

        $token = Str::random(60);
        Cache::put(
            $topic . '_remember_' . $arg,
            $token,
            now()->addMinutes(5) // Can be modified
        );

        return $token;
    }

    /**
     * Create an OTP and store it in cache
     *
     * @param string $topic
     * @param string $arg
     * @return int
     */
    public function create(string $topic, string $arg): int
    {
        $code = $this->generate();
        Cache::put(
            $topic . '_code_' . $arg,
            $code,
            now()->addMinutes(5) // Can be modified
        );

        return $code;
    }

    /**
     * Send the OTP to user
     *
     * @param $code
     * @return void
     */
    public function send($code)
    {
        // TODO: Send Mail, SMS...
    }

    /**
     * Generate an OTP
     *
     * @return int
     */
    private function generate(): int
    {
        return rand(100000, 999999); // Can be modified
    }
}
