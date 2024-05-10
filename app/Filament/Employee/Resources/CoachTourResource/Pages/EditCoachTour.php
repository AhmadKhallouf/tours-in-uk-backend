<?php

namespace App\Filament\Employee\Resources\CoachTourResource\Pages;

use App\Filament\Employee\Pages\EditService;
use App\Filament\Employee\Resources\CoachTourResource;
use Filament\Actions;

class EditCoachTour extends EditService
{
    protected static string $resource = CoachTourResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
