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

class VipServiceBookingService implements BaseBookingService
{

    public static function book(VipService|Tour|CoachTour $bookable, array $data): Booking
    {
        self::checkServiceType($bookable);
        $vipService = $bookable;

        // TODO: test
        Validator::make($data, [
            'guests_count' => 'required|integer|min:1',
            'date' => 'required|date|after_or_equal:today',
            'name' => 'required|string',
            'phone' => 'required|string',
            'vehicle_id' => 'required|integer|exists:cars,id',
            'message' => 'string',
            'destination' => 'required|string',
            'partner_id' => 'numeric|exists:partners,id',
        ])->validate();
        $data['date'] = Carbon::parse($data['date']);
        $data['user_id'] = Auth::id();
        $data['price_per_guest'] = $vipService->price;
        $totalAmount = $data['guests_count'] * $vipService->price;
        $partner = array_key_exists('partner_id', $data) ?
            Partner::find($data['partner_id']) :
            null;
        $shares = PriceService::getShares($totalAmount, $partner);

        $data['net_profit'] = $shares['company_share'];
        $data['partner_share'] = $shares['partner_share'];
        $booking = $vipService->bookings()->create($data);

        return $booking;
    }

    /**
     * @throws Exception
     */
    public static function checkServiceType(VipService|Tour|CoachTour $bookable): void
    {
        if (!$bookable instanceof VipService)
            throw new Exception('Booking does not belong to a VIP service.');
    }

    /**
     * @throws Exception
     */
    private static function getTourDayIfBookingAvailable(VipService $vipService, $date): void
    {
        $date = Carbon::parse($date);

        $firstDay = Carbon::parse($vipService->first_day);
        $lastDay = Carbon::parse($vipService->last_day);

        if (!$date->between($firstDay, $lastDay)) {
            throw new Exception('The date provided is not between the first and last day of the VIP service.');
        }
    }

    /**
     * @throws Exception
     */
    public static function approve(Booking $booking): void
    {
        $vipService = $booking->bookable;
        self::checkServiceType($vipService);

        self::getTourDayIfBookingAvailable($vipService, $booking->date);
        $booking->update(['status' => 'approved']);
    }

    /**
     * @throws Exception
     */
    public static function decline(Booking $booking): void
    {
        $vipService = $booking->bookable;
        self::checkServiceType($vipService);

        self::getTourDayIfBookingAvailable($vipService, $booking->date);
        $booking->update(['status' => 'declined']);
    }
}
