<?php

namespace App\Filament\Employee\Resources\VipServiceBookingResource\Pages;

use App\Filament\Employee\Pages\ListBookings;
use App\Filament\Employee\Resources\VipServiceBookingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVipServiceBookings extends ListBookings
{
    protected static string $resource = VipServiceBookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
