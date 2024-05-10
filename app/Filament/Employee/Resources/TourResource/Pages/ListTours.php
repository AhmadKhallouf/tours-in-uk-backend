<?php

namespace App\Filament\Employee\Resources\TourResource\Pages;

use App\Filament\Employee\Resources\TourResource;
use App\Models\Booking;
use App\Models\Tour;
use Filament\Actions;
use Filament\Forms\Components\Tabs;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use function Clue\StreamFilter\fun;

class ListTours extends ListRecords
{
    protected static string $resource = TourResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
