<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\CoachTour;
use App\Models\Day;
use App\Models\Partner;
use App\Models\Tour;
use App\Models\VipService;
use Auth;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Validation\ValidationException;
use LaravelIdea\Helper\App\Models\_IH_Day_QB;
use Validator;

class CoachTourBookingService implements BaseBookingService
{

    /**
     * @throws Exception
     */
    public static function book(VipService|Tour|CoachTour $bookable, array $data): Booking
    {
        self::checkServiceType($bookable);
        $coachTour = $bookable;

        Validator::make($data, [
            'destination' => 'required|string',
            'guests_count' => 'required|numeric',
            'name' => 'required|string',
            'phone' => 'required|string',
            'driver_id' => 'required|numeric',
            'vehicle_id' => 'required|numeric',
            'message' => 'string',
            'date' => 'required|date|after_or_equal:today',
            'partner_id' => 'numeric|exists:partners,id',
        ])->validate();

        $data['date'] = Carbon::parse($data['date']);
        $data['user_id'] = Auth::id();

        $data['price_per_guest'] = $coachTour->price;
        $totalAmount = $data['guests_count'] * $coachTour->price;
        $partner = array_key_exists('partner_id', $data) ?
            Partner::find($data['partner_id']) :
            null;
        $shares = PriceService::getShares($totalAmount, $partner);

        $data['net_profit'] = $shares['company_share'];
        $data['partner_share'] = $shares['partner_share'];
        $booking = $coachTour->bookings()->create($data);
        return $booking;
    }

    /**
     * @throws Exception
     */
    public static function checkServiceType(VipService|Tour|CoachTour $bookable): void
    {
        if (!$bookable instanceof CoachTour)
            throw new Exception('Booking does not belong to a coach tour.');
    }

    /**
     * @throws Exception
     */
    public static function approve(Booking $booking): void
    {
        $coachTour = $booking->bookable;
        self::checkServiceType($coachTour);

        $booking->update(['status' => 'approved']);
    }

    /**
     * @throws Exception
     */
    public static function decline(Booking $booking): void
    {
        $coachTour = $booking->bookable;
        self::checkServiceType($coachTour);

        $booking->update(['status' => 'declined']);
    }
}
