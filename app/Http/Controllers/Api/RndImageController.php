<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\RandImageProviderService;
use Exception;
use Illuminate\Http\Request;

class RndImageController extends Controller
{
    protected RandImageProviderService $imageProviderService;

    public function __construct(RandImageProviderService $imageProviderService)
    {
        $this->imageProviderService = $imageProviderService;
    }

    /**
     * @throws Exception
     */
    public function getRandomImage()
    {
        return response()->api(
            $this->imageProviderService->getRandomImage()
        );
    }
}
