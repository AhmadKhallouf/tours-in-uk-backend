<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function current()
    {
        $user = User::find(Auth::id());
        if ($user->is_partner) {
            $user->load('partner');
        }

        return response()->api($user);
    }

    public function bookings(Request $request)
    {
        $user = Auth::user();
        $bookings = $user->bookings;
        if (!$bookings) {
            throw new ModelNotFoundException('No bookings found for this user.');
        }

        return response()->api($bookings);
    }

    public function updateInfo(Request $request)
    {
        $user = Auth::user();
        $this->userService->updateInfo($user, $request->all());

        return response()->api(
            $user,
            'User info updated.'
        );
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        $this->userService->updatePassword($user, $request->all());

        return response()->api(
            $user,
            'User password updated.'
        );
    }
}
