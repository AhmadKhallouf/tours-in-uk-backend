<?php

namespace App\Filament\Employee\Resources\VipServicesPageResource\Pages;

use App\Filament\Employee\Resources\VipServicesPageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVipServicesPage extends EditRecord
{
    protected static string $resource = VipServicesPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
