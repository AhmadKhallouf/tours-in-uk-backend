<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CoachTour;
use App\Services\CoachTourBookingService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class CoachTourController extends Controller
{
    protected CoachTourBookingService $bookingService;

    public function __construct(CoachTourBookingService $service)
    {
        $this->bookingService = $service;
    }

    public function index()
    {
        $coachesTours = CoachTour::all();

        // TODO: filters
        if ($coachesTours->count() == 0) {
            throw new ModelNotFoundException('No coach tours found.');
        }
        return response()->api($coachesTours);
    }

    public function show(CoachTour $coachTour)
    {
        return response()->api($coachTour);
    }

    /**
     * @throws Exception
     */
    public function book(Request $request, CoachTour $coachTour)
    {
        $booking = $this->bookingService->book($coachTour, $request->all());

        return response()->api(
            $booking,
            'Coach tour booking created, wait for admin approval.',
            HttpResponse::HTTP_CREATED,
        );
    }
}
