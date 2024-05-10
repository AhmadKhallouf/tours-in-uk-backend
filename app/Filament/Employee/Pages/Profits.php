<?php

namespace App\Filament\Employee\Pages;

use App\Filament\Components\BaseResource;
use App\Filament\Employee\Pages\ProfitsPage\MonthlyProfitChart;
use App\Filament\Employee\Pages\ProfitsPage\ProfitStats;
use App\Filament\Employee\Pages\ProfitsPage\YearlyProfitChart;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;


class Profits extends Page
{
    use BaseDashboard\Concerns\HasFiltersForm;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static string $view = 'filament.employee.pages.profit';

    protected static ?int $navigationSort = 1;

    public function filtersForm(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        DatePicker::make(__('filament-panels::pages/dashboard.actions.filter.start_date'))
                            ->maxDate(fn(Get $get) => $get('endDate') ?: now()),
                        DatePicker::make(__('filament-panels::pages/dashboard.actions.filter.end_date'))
                            ->minDate(fn(Get $get) => $get('startDate') ?: now())
                            ->maxDate(now()),
                    ])
                    ->columns(2),
            ]);
    }

    public function getTitle(): string|Htmlable
    {
        return ucfirst(BaseResource::getCustomModelLabel(strtolower(parent::getTitle())));
    }

    public static function getNavigationLabel(): string
    {
        return ucfirst(BaseResource::getCustomModelLabel(strtolower(parent::getNavigationLabel())));
    }

    protected function getHeaderWidgets(): array
    {
        return [
            ProfitStats::class,
            MonthlyProfitChart::class,
            YearlyProfitChart::class,
        ];
    }
}
