<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
use Lang;

/**
 * PADStatus enum class representing the status of PAD (Pending Approved Declined) entities.
 */
enum PADStatus: string implements HasColor, HasIcon, HasLabel
{
    case Pending = 'pending';

    case Approved = 'approved';

    case Declined = 'declined';

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Pending => 'warning',
            self::Approved => 'success',
            self::Declined => 'danger',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Pending => 'heroicon-o-clock',
            self::Approved => 'heroicon-o-check-circle',
            self::Declined => 'heroicon-o-exclamation-circle',
        };
    }

    public function getLabel(): ?string
    {
        $localeKey = "filament-panels::resources/labels.$this->name.state";
        if (Lang::has($localeKey))
            return Lang::get($localeKey);
        return $this->name;
    }
}
