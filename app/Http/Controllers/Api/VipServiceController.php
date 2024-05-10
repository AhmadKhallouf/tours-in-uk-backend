<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\VipService;
use App\Services\VipServiceBookingService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class VipServiceController extends Controller
{
    protected VipServiceBookingService $bookingService;

    public function __construct(VipServiceBookingService $service)
    {
        $this->bookingService = $service;
    }

    public function index()
    {
        $vipServices = VipService::paginate(10);

        if ($vipServices->isEmpty()) {
            throw new ModelNotFoundException('No VIP services found.');
        }

        return response()->api($vipServices);
    }

    public function show(VipService $vipService)
    {
        return response()->api($vipService);
    }

    public function book(Request $request, VipService $vipService)
    {
        $booking = $this->bookingService->book($vipService, $request->all());

        return response()->api(
            $booking,
            'VIP service booking created, waiting for admin approval',
            HttpResponse::HTTP_CREATED,
        );
    }
}
