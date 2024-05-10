<?php

namespace App\Filament\Employee\Resources\CoachToursPageResource\Pages;

use App\Filament\Employee\Resources\CoachToursPageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCoachToursPages extends ListRecords
{
    protected static string $resource = CoachToursPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
