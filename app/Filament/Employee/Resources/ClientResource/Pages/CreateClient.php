<?php

namespace App\Filament\Employee\Resources\ClientResource\Pages;

use App\Filament\Components\CreateUser;
use App\Filament\Employee\Resources\ClientResource;

class CreateClient extends CreateUser
{
    protected static string $resource = ClientResource::class;
}
