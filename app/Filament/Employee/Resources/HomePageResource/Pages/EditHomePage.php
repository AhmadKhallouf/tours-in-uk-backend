<?php

namespace App\Filament\Employee\Resources\HomePageResource\Pages;

use App\Filament\Employee\Resources\HomePageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditHomePage extends EditRecord
{

    protected static string $resource = HomePageResource::class;
}
