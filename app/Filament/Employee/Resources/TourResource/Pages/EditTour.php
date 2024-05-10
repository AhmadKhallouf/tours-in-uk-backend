<?php

namespace App\Filament\Employee\Resources\TourResource\Pages;

use App\Filament\Employee\Pages\EditService;
use App\Filament\Employee\Resources\TourResource;
use Filament\Actions;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;

class EditTour extends EditService
{
    protected static string $resource = TourResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
