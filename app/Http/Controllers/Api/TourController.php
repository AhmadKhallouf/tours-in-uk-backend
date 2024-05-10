<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Services\TourBookingService;
use Date;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Laravel\Scout\Searchable;
use PHPUnit\Event\TestData\MoreThanOneDataSetFromDataProviderException;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class TourController extends Controller
{
    use Searchable;

    protected TourBookingService $tourBookingService;

    public function __construct(TourBookingService $tourBookingService)
    {
        $this->tourBookingService = $tourBookingService;
    }

    public function index(Request $request)
    {
        $request->validate([
            'city' => 'string',
            'start_date' => 'date|after_or_equal:today',
            'end_date' => 'date|after_or_equal:start_date',
            'min_price' => 'numeric',
            'max_price' => 'numeric',
            'guests_count' => 'numeric',
            'partner_id' => 'numeric|exists:partners,id',
        ]);

        $tours = Tour::query();
        $tours = $tours->applyFilters($request->all());

        if ($tours->count() == 0) {
            throw new ModelNotFoundException('No tours found.');
        }

        $tours = $tours->paginate(10);
        return response()->api($tours);
    }

    public function show(Tour $tour)
    {
        $tour->load(['days', 'events', 'activities']);
        return response()->api($tour);
    }

    /**
     * @throws Exception
     */
    public function book(Request $request, Tour $tour)
    {
        $booking = $this->tourBookingService->book($tour, $request->all());

        return response()->api(
            $booking,
            'Tour booking created, pending approval.',
            HttpResponse::HTTP_CREATED
        );
    }

    public function getDay(Tour $tour, $day)
    {
        $date = date('Y-m-d', strtotime($day));
        return response()->api(
            $this->tourBookingService->getTourDayIfBookingAvailable($tour, $date)
        );
    }
}
