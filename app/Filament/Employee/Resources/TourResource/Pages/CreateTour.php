<?php

namespace App\Filament\Employee\Resources\TourResource\Pages;

use App\Filament\Employee\Resources\TourResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTour extends CreateRecord
{
    protected static string $resource = TourResource::class;

    // TODO: Get city from location
}
