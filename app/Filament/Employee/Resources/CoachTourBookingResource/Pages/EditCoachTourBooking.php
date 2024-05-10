<?php

namespace App\Filament\Employee\Resources\CoachTourBookingResource\Pages;

use App\Filament\Employee\Resources\CoachTourBookingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCoachTourBooking extends EditRecord
{
    protected static string $resource = CoachTourBookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
