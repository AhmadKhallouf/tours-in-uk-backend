<?php

namespace App\Filament\Employee\Resources;

use App\Filament\Components\BaseResource;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class ServiceResource extends BaseResource
{
    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function getNavigationGroup(): ?string
    {
        return static::getTitleCasePluralModelLabel();
    }
}
