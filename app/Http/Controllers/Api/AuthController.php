<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use App\Services\TokenService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class AuthController extends Controller
{
    protected AuthService $authService;
    protected TokenService $tokenService;
    protected UserService $userService;

    public function __construct(
        AuthService  $authService,
        TokenService $tokenService,
        UserService  $userService
    )
    {
        $this->authService = $authService;
        $this->tokenService = $tokenService;
        $this->userService = $userService;
    }


    /**
     * @throws ValidationException
     */
    public function login(Request $request)
    {
        $user = $this->authService->loginOrFail($request->all());
        $token = $this->tokenService->create($user);

        return response()->api(
            [
                'token' => $token,
                'user' => $user,
            ],
            __('User authenticated.'),
        );
    }

    /**
     * @throws ValidationException
     */
    public function register(Request $request)
    {
        // Create a user
        $user = $this->userService->create($request->all());

        // Assign user role to it
        $user->assignRole('client');

        // Generate an auth token
        $token = $this->tokenService->create($user);

        return response()->api(
            [
                'token' => $token,
                'user' => $user,
            ],
            __('User created.'),
            HttpResponse::HTTP_CREATED,
        );
    }

    public function logout(Request $request)
    {
        $this->tokenService->revoke(Auth::user());

        return response()->api(
            null,
            __('User logged out.')
        );
    }
}
