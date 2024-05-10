<?php

namespace App\Filament\Employee\Pages;

use Artisan;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Forms\Get;

use Filament\Pages\Dashboard as BaseDashboard;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Foundation\Inspiring;

class Dashboard extends BaseDashboard
{
    use BaseDashboard\Concerns\HasFiltersForm;

    public function filtersForm(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        DatePicker::make(__("filament-panels::pages/dashboard.actions.filter.start_date"))
                            ->maxDate(fn(Get $get) => $get('endDate') ?: now()),
                        DatePicker::make(__("filament-panels::pages/dashboard.actions.filter.end_date"))
                            ->minDate(fn(Get $get) => $get('startDate') ?: now())
                            ->maxDate(now()),
                    ])
                    ->columns(2),
            ]);
    }
}
