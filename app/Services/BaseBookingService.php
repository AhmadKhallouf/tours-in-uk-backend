<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\CoachTour;
use App\Models\ServiceModel;
use App\Models\Tour;
use App\Models\VipService;

interface BaseBookingService
{
    public static function book(Tour|VipService|CoachTour $bookable, array $data): Booking;

    public static function checkServiceType(Tour|VipService|CoachTour $bookable);

    public static function approve(Booking $booking);

    public static function decline(Booking $booking);
}
