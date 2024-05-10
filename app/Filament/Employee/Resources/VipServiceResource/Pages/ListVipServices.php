<?php

namespace App\Filament\Employee\Resources\VipServiceResource\Pages;

use App\Filament\Employee\Resources\VipServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVipServices extends ListRecords
{
    protected static string $resource = VipServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
