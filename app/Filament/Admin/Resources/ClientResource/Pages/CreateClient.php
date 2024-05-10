<?php

namespace App\Filament\Admin\Resources\ClientResource\Pages;

use App\Enums\UserRole;
use App\Filament\Admin\Resources\ClientResource;
use App\Filament\Components\BaseUserResource;
use App\Filament\Components\CreateUser;
use App\Models\User;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateClient extends CreateUser
{
    protected static string $resource = ClientResource::class;
}
