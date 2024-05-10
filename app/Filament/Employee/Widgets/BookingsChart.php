<?php

namespace App\Filament\Employee\Widgets;

use App\Models\Booking;
use App\Models\Vehicle;
use Illuminate\Support\Carbon;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Contracts\Support\Htmlable;
use Lang;

class BookingsChart extends BaseBookingChart
{
    use InteractsWithPageFilters;
}
