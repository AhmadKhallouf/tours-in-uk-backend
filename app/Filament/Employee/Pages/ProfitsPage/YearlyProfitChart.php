<?php

namespace App\Filament\Employee\Pages\ProfitsPage;

use App\Filament\Employee\Widgets\BaseBookingChart;
use App\Models\Booking;
use App\Models\Vehicle;
use Illuminate\Support\Carbon;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Contracts\Support\Htmlable;
use Lang;
use Number;

class YearlyProfitChart extends ChartWidget
{
    use InteractsWithPageFilters;

    public function getHeading(): string|Htmlable|null
    {
        return __('filament-panels::resources/labels.yearly_profit');
    }

    protected function getData(): array
    {
        $data = Trend::query(
            Booking::query()
                ->where('payment_status', 'approved')
        )
            ->dateColumn('created_at')
            ->dateAlias('created_at')
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->sum('net_profit');

        return [
            'datasets' => [
                [
                    'label' => 'Profit',
                    'data' => $data->map(fn(TrendValue $value) => $value->aggregate),
                    'fill' => 'start',
                ],
            ],
            'labels' => $data->map(fn(TrendValue $value) => Carbon::parse($value->date)->format('M'))
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
