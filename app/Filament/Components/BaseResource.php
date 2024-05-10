<?php

namespace App\Filament\Components;

use App\Enums\UserRole;
use Auth;
use Filament\Panel;
use Filament\Resources\Resource;
use Illuminate\Auth\Access\Response;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Lang;
use phpDocumentor\Reflection\Types\Parent_;
use Str;

abstract class BaseResource extends Resource
{
    public static function getEloquentQuery(): Builder
    {
        return self::getModel()::query()
            ->withoutGlobalScope('available')
            ->withoutGlobalScope('active');
    }

    public static function canView(Model $record): bool
    {
        return true;
    }

    public static function getModelLabel(): string
    {
        return self::getCustomModelLabel(parent::getModelLabel());
    }

    public static function getPluralModelLabel(): string
    {
        return self::getCustomPluralModelLabel(parent::getModelLabel());
    }

    public static function getCustomModelLabel($label): array|string|null
    {
        $key = "filament-panels::resources/labels.$label.singular";
        if (Lang::has($key)) {
            return Lang::get($key);
        }

        return $label;
    }

    public static function getCustomPluralModelLabel($label): array|string|null
    {
        $key = "filament-panels::resources/labels.$label.plural";
        if (Lang::has($key)) {
            return Lang::get($key);
        }

        return Str::plural($label);
    }

    public static function canAccess(): bool
    {
        $user = Auth::user();
        if ($user->hasRole(UserRole::EMPLOYEE->value)) {

            // Get the navigation label in English
            $previous_locale = Lang::getLocale();
            Lang::setLocale('en');
            $permission = Str::snake(self::GetNavigationLabel());
            Lang::setLocale($previous_locale);
            return $user->hasPermissionTo($permission);
        }
        return true;
    }
}
