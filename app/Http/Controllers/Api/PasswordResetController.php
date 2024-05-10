<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PasswordResetService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PasswordResetController extends Controller
{
    protected PasswordResetService $passwordResetService;

    public function __construct(PasswordResetService $passwordResetService)
    {
        $this->passwordResetService = $passwordResetService;
    }

    /**
     * @throws ValidationException
     */
    public function sendResetLinkViaEmail(Request $request)
    {
        $this->passwordResetService->sendResetLink($request->only(['email']));

        return response()->api(
            null,
            'Check your email for a reset link.',
        );
    }

    /**
     * @throws ValidationException
     */
    public function reset(Request $request)
    {
        $this->passwordResetService->reset($request->all());

        return response()->api(
            null,
            'Your password has been reset.',
        );
    }
}
