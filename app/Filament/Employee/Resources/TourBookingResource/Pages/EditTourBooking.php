<?php

namespace App\Filament\Employee\Resources\TourBookingResource\Pages;

use App\Filament\Employee\Resources\TourBookingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTourBooking extends EditRecord
{
    protected static string $resource = TourBookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
