<?php

namespace App\Filament\Employee\Resources\AboutUsPageResource\Pages;

use App\Filament\Employee\Resources\AboutUsPageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAboutUsPage extends EditRecord
{
    protected static string $resource = AboutUsPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
