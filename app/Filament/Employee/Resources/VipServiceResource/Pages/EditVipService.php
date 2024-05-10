<?php

namespace App\Filament\Employee\Resources\VipServiceResource\Pages;

use App\Filament\Employee\Pages\EditService;
use App\Filament\Employee\Resources\VipServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVipService extends EditService
{
    protected static string $resource = VipServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
