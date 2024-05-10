<?php

namespace App\Filament\Components;

use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

abstract class CreateUser extends CreateRecord
{
    protected function handleRecordCreation(array $data): Model
    {
        return static::$resource::handleRecordCreation($data);
    }
}
