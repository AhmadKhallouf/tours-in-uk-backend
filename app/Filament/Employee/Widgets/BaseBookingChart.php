<?php

namespace App\Filament\Employee\Widgets;

use App\Models\Booking;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Lang;
use LaravelIdea\Helper\App\Models\_IH_Booking_QB;
use Str;

abstract class BaseBookingChart extends ChartWidget
{
    use InteractsWithPageFilters;

    public function getQuery(): _IH_Booking_QB|Builder
    {
        return Booking::query();
    }

    public function getHeading(): string|Htmlable|null
    {
        $name = Str::snake(class_basename($this));
        $key = "filament-panels::widgets/widget-headings.$name";
        $englishName = Str::replaceLast(' chart', '',
            ucfirst(Str::snake(class_basename($this), ' '))
        );
        return Lang::has($key) ?
            __($key) :
            $englishName;
    }

    protected function getData(): array
    {
        $startDate = !is_null($this->filters['startDate'] ?? null) ?
            Carbon::parse($this->filters['startDate']) :
            now()->subDays(15);

        $endDate = !is_null($this->filters['endDate'] ?? null) ?
            Carbon::parse($this->filters['endDate']) :
            now()->addDays(15);


        $data = Trend::query($this->getQuery())
            ->dateColumn('date')
            ->dateAlias('date')
            ->between(
                start: $startDate,
                end: $endDate,
            )
            ->perDay()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Bookings',
                    'data' => $data->map(fn(TrendValue $value) => $value->aggregate),
                    'fill' => 'start',
                ],
            ],
            'labels' => $data->map(fn(TrendValue $value) => Carbon::parse($value->date)->format('d M'))
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
