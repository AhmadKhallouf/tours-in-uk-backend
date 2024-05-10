<?php

namespace App\Filament\Employee\Resources\ClientResource\Pages;

use App\Filament\Components\BaseUserResource;
use App\Filament\Employee\Resources\ClientResource;
use Filament\Actions;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;

class EditClient extends EditRecord
{
    protected static string $resource = ClientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function form(Form $form): Form
    {
        return BaseUserResource::editForm($form);
    }
}
