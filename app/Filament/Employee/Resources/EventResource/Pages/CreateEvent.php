<?php

namespace App\Filament\Employee\Resources\EventResource\Pages;

use App\Filament\Employee\Resources\EventResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEvent extends CreateRecord
{
    protected static string $resource = EventResource::class;
}
