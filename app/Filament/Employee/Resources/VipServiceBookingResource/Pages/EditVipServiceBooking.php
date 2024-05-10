<?php

namespace App\Filament\Employee\Resources\VipServiceBookingResource\Pages;

use App\Filament\Employee\Resources\VipServiceBookingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVipServiceBooking extends EditRecord
{
    protected static string $resource = VipServiceBookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
