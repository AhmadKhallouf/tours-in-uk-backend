<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Vehicle;
use App\Models\CoachTour;
use App\Models\Day;
use App\Models\Partner;
use App\Models\ServiceModel;
use App\Models\Tour;
use App\Models\VipService;
use Carbon\Carbon;
use Exception;
use Faker\Provider\Base;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use LaravelIdea\Helper\App\Models\_IH_Day_QB;

class TourBookingService implements BaseBookingService
{
    /**
     * @throws Exception
     */
    public static function checkServiceType(Tour|VipService|CoachTour $bookable): void
    {
        if (!$bookable instanceof Tour)
            throw new Exception('Booking does not belong to a tour.');
    }

    public static function getTourDayIfBookingAvailable(Tour $tour, $date, $guests_count = 0): Model|_IH_Day_QB|HasMany|Day|null
    {
        $date = Carbon::parse($date)->format('Y-m-d');

        $tourDay = $tour->days()->where('date', $date)->first();

        if ($tourDay === null) {
            throw new ModelNotFoundException('Tour has no day with date ' . $date);
        }
        if ($guests_count > $tourDay->remaining_seats) {
            throw ValidationException::withMessages([
                'guests_count' => 'Not enough seats available.',
            ]);
        }
        return $tourDay;
    }

    /**
     * @throws Exception
     */
    public static function book(Tour|VipService|CoachTour $bookable, array $data): Booking
    {
        Validator::make($data, [
            'date' => 'required|date|after_or_equal:today',
            'guests_count' => 'required|numeric|min:1',
            'phone' => 'required|string',
            'name' => 'string|required',
            'message' => 'string',
            'partner_id' => 'numeric|exists:partners,id'
        ])->validate();

        $data['date'] = Carbon::parse($data['date']);
        self::checkServiceType($bookable);
        $tour = $bookable;

        self::getTourDayIfBookingAvailable(
            $tour,
            $data['date'],
            $data['guests_count'],
        );

        $data['user_id'] = Auth::id();

        $data['price_per_guest'] = $tour->price;
        $totalAmount = $data['guests_count'] * $tour->price;
        $partner = array_key_exists('partner_id', $data) ?
            Partner::find($data['partner_id']) :
            null;
        $shares = PriceService::getShares($totalAmount, $partner);

        $data['net_profit'] = $shares['company_share'];
        $data['partner_share'] = $shares['partner_share'];

        return $tour->bookings()->create($data);
    }

    /**
     * @throws Exception
     */
    public static function approve(Booking $booking): void
    {
        $tour = $booking->bookable;
        self::checkServiceType($tour);

        $tourDay = self::getTourDayIfBookingAvailable(
            $tour,
            $booking->date,
            $booking->guests_count,
        );

        $tourDay->decrement('remaining_seats', $booking->guests_count);
        $booking->update(['status' => 'approved']);
    }

    /**
     * @throws Exception
     */
    public static function decline(Booking $booking): void
    {
        $tour = $booking->bookable;
        self::checkServiceType($tour);

        $tourDay = self::getTourDayIfBookingAvailable(
            $tour,
            $booking->date,
            0,
        );

        $booking->update(['status' => 'declined']);
    }
}
