<?php

namespace App\Http\Controllers;

use Exception;
use Http\Discovery\Exception\NotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FavoriteController extends Controller
{
    /**
     * @throws Exception
     */
    public function addFavorite(Request $request)
    {
        $request->validate([
            'favoritable_id' => 'required',
            'favoritable_type' => 'required',
        ]);

        $user = Auth::user();
        $favId = $request->get('favoritable_id');
        $favType = 'App\\Models\\' . $request->get('favoritable_type');


        // Check if favorite already exists
        $favorite = $user->favorites()
            ->where('favoritable_id', $favId)
            ->where('favoritable_type', $favType);

        if ($favorite->exists()) {
            throw new Exception('Favorite already exists.');
        }

        // Create a favorite relation
        $user->favorites()->create([
            'favoritable_id' => $favId,
            'favoritable_type' => $favType,
        ]);

        return response()->api([
            null,
            'Added to favorites.',
            HttpResponse::HTTP_CREATED,
        ]);
    }


    /**
     * @throws Exception
     */
    public function removeFavorite(Request $request)
    {
        $request->validate([
            'favoritable_id' => 'required',
            'favoritable_type' => 'required',
        ]);

        $user = Auth::user();
        $favId = $request->get('favoritable_id');
        $favType = 'App\\Models\\' . $request->get('favoritable_type');

        // Check if the favorite exists
        $favorite = $user->favorites()
            ->where('favoritable_id', $favId)
            ->where('favoritable_type', $favType)
            ->first();

        if (!$favorite) {
            throw new NotFoundHttpException('Favorite not found.');
        }

        // Remove the favorite
        $favorite->delete();

        return response()->api([
            null,
            'Removed from favorites.',
            HttpResponse::HTTP_OK,
        ]);
    }


    public function favorites()
    {
        $user = Auth::user();

        $favorites = $user->favorites()->get();

        return response()->api($favorites);
    }
}
