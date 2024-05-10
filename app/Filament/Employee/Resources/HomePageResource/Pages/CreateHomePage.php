<?php

namespace App\Filament\Employee\Resources\HomePageResource\Pages;

use App\Filament\Employee\Resources\HomePageResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateHomePage extends CreateRecord
{
    protected static string $resource = HomePageResource::class;
}
