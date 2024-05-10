<?php

namespace App\Filament\Employee\Resources\ContactUsPageResource\Pages;

use App\Filament\Employee\Resources\ContactUsPageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListContactUsPages extends ListRecords
{
    protected static string $resource = ContactUsPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
