<?php

namespace App\Filament\Employee\Resources\ContactUsPageResource\Pages;

use App\Filament\Employee\Resources\ContactUsPageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditContactUsPage extends EditRecord
{
    protected static string $resource = ContactUsPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
