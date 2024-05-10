<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AboutUsPage;
use App\Models\ContactUsPage;
use App\Models\HomePage;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PageController extends Controller
{

    /**
     * Caches the given closure with the specified key for a certain duration.
     *
     * @param string $cacheKey
     * @param Closure $closure
     * @param int $cacheDuration
     * @return mixed
     */
    private function cacheResponse(string $cacheKey, Closure $closure, int $cacheDuration = 60)
    {
        return Cache::remember($cacheKey, $cacheDuration, $closure);
    }


    public function home()
    {
        return $this->cacheResponse('home_page', function () {
            return response()->api(HomePage::first());
        });
    }

    public function aboutUs()
    {
        return $this->cacheResponse('about_us', function () {
            return response()->api(AboutUsPage::first());
        });
    }

    public function contactUs()
    {
        return $this->cacheResponse('contact_us', function () {
            return response()->api(ContactUsPage::first());
        });
    }
}
