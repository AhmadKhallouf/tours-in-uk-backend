<?php

namespace App\Filament\Employee\Pages\ProfitsPage;

use App\Enums\UserRole;
use App\Models\Booking;
use App\Models\Partner;
use App\Models\User;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

class ProfitStats extends BaseWidget
{
    use InteractsWithPageFilters;

    protected function getStats(): array
    {
        $query = Booking::query();

        $startDate = $this->filters['startDate'] ?? null;
        if ($startDate) {
            $startDate = $startDate instanceof Carbon ? $startDate : new Carbon($startDate);
            $query = $query->where('date', '>=', $startDate);
        }

        $endDate = $this->filters['endDate'] ?? null;
        if ($endDate) {
            $endDate = $endDate instanceof Carbon ? $endDate : new Carbon($endDate);
            $query = $query->where('date', '<=', $endDate);
        }
        $query->where('payment_status', 'approved');
        $totalProfit = $query->get()->sum('net_profit');

        // Daily Profit
        $dailyProfitQuery = (clone $query);
        $dailyProfit = $dailyProfitQuery
            ->whereDate('date', Carbon::today())
            ->get()
            ->sum('net_profit');

        // Monthly Profit
        $monthlyProfitQuery = (clone $query);
        $monthlyProfit = $monthlyProfitQuery
            ->whereYear('date', Carbon::now()->year)
            ->whereMonth('date', Carbon::now()->month)
            ->get()
            ->sum('net_profit');

        // Yearly Profit
        $yearlyProfitQuery = (clone $query);
        $yearlyProfit = $yearlyProfitQuery
            ->whereYear('date', Carbon::now()->year)
            ->get()
            ->sum('net_profit');

        return [
            Stat::make(
                __('filament-panels::resources/labels.total_profit'),
                \Number::abbreviate($totalProfit)
            ),
            Stat::make(
                __('filament-panels::resources/labels.daily_profit'),
                \Number::abbreviate($dailyProfit)
            ),
            Stat::make(
                __('filament-panels::resources/labels.monthly_profit'),
                \Number::abbreviate($monthlyProfit)
            ),
            Stat::make(
                __('filament-panels::resources/labels.yearly_profit'),
                \Number::abbreviate($yearlyProfit)
            ),
            Stat::make(
                __('filament-panels::resources/labels.total_clients'),
                User::role(UserRole::CLIENT->value)->get()->count(),
            ),
            Stat::make(
                __('filament-panels::resources/labels.total_partners'),
                Partner::all()->count(),
            )
        ];
    }
}
