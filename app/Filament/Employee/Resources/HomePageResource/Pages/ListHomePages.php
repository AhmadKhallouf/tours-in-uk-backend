<?php

namespace App\Filament\Employee\Resources\HomePageResource\Pages;

use App\Filament\Employee\Resources\HomePageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHomePages extends ListRecords
{
    protected static string $resource = HomePageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
