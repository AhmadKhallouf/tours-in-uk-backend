<?php

namespace App\Filament\Components;

use App\Enums\PADStatus;
use Closure;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Contracts\Support\Htmlable;

class StatusTextColumn extends TextColumn
{
    public function getColor(mixed $state): string|array|null
    {
        return PADStatus::from($state)->getColor();
    }

    public function getIcon(mixed $state): ?string
    {
        return PADStatus::from($state)->getIcon();
    }

    public function formatState(mixed $state): mixed
    {
        return ucfirst($state);
    }

    /**
     * @return bool
     */
    public function isSortable(): bool
    {
        return true;
    }

    public function isBadge(): bool
    {
        return true;
    }
}
