<?php

namespace App\Filament\Employee\Resources\VipServicesPageResource\Pages;

use App\Filament\Employee\Resources\VipServicesPageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVipServicesPages extends ListRecords
{
    protected static string $resource = VipServicesPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
