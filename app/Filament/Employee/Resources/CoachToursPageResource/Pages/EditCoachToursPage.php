<?php

namespace App\Filament\Employee\Resources\CoachToursPageResource\Pages;

use App\Filament\Employee\Resources\CoachToursPageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCoachToursPage extends EditRecord
{
    protected static string $resource = CoachToursPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
