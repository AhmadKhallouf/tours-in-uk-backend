<?php

namespace App\Filament\Employee\Resources;


use App\Filament\Components\BaseResource;
use Illuminate\Database\Eloquent\Model;

abstract class ContentResource extends BaseResource
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getNavigationGroup(): ?string
    {
        return ucfirst(__('filament-panels::resources/labels.content'));
    }

    public static function getPluralModelLabel(): string
    {
        return parent::getModelLabel();
    }
}
