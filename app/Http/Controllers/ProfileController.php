<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    protected function getCurrentUserProfile()
    {
        return UserProfile::where('user_id', Auth::user()->id)->firstOrFail();
    }

    public function profile()
    {
        return response()->api(
            $this->getCurrentUserProfile()
        );
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'cover_photo' => 'image',
            'profile_picture' => 'image',
            'bio' => 'string',
        ]);

        $user_profile = $this->getCurrentUserProfile();
        $updated = false;

        if ($request->hasFile('cover_photo')) {
            $updated = true;
            $cover_photo = $request->file('cover_photo')->store('public/cover_photos');
            $user_profile->cover_photo = 'cover_photos/' . basename($cover_photo);
        }
        if ($request->hasFile('profile_picture')) {
            $updated = true;
            $profile_picture = $request->file('profile_picture')->store('public/profile_pictures');
            $user_profile->profile_picture = 'profile_pictures/' . basename($profile_picture);
        }
        if ($request->has('bio')) {
            $updated = true;
            $user_profile->bio = $request->bio;
        }

        $user_profile->save();

        return response()->api(
            $user_profile,
            $updated ? 'User profile updated.' : 'Nothing to update.'
        );
    }
}
