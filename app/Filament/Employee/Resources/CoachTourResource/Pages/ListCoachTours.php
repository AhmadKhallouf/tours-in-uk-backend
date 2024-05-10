<?php

namespace App\Filament\Employee\Resources\CoachTourResource\Pages;

use App\Filament\Employee\Resources\CoachTourResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCoachTours extends ListRecords
{
    protected static string $resource = CoachTourResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
