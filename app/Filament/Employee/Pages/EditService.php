<?php

namespace App\Filament\Employee\Pages;

use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;

class EditService extends EditRecord
{
    // Control the fields that can be edited when editing a service.
    // For now, only the relations are editable
    public function form(Form $form): Form
    {
        return $form->schema([
            MarkdownEditor::make('description'),
            Toggle::make('is_available'),
            TextInput::make('price')
                ->required()
                ->numeric(),
        ]);
    }
}
