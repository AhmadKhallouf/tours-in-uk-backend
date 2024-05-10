<?php

namespace App\Filament\Employee\Resources\VehicleResource\Pages;

use App\Filament\Employee\Resources\VehicleResource;
use App\Models\Vehicle;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateVehicle extends CreateRecord
{
    protected static string $resource = VehicleResource::class;
}
