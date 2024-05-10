<?php

namespace App\Filament\Employee\Widgets;

use App\Models\Booking;
use App\Models\VipService;
use Illuminate\Database\Eloquent\Builder;
use LaravelIdea\Helper\App\Models\_IH_Booking_QB;

class VipServicesBookingsChart extends BaseBookingChart
{
    public function getQuery(): _IH_Booking_QB|Builder
    {
        return Booking::query()->where('bookable_type', VipService::class);
    }
}
