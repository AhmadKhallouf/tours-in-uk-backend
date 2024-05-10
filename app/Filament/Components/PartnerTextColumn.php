<?php

namespace App\Filament\Components;

use Filament\Tables\Columns\TextColumn;
use Illuminate\Contracts\Support\Htmlable;

class PartnerTextColumn extends TextColumn
{
    public function getLabel(): string|Htmlable
    {
        return 'Partner';
    }

    /**
     * @return bool
     */
    public function isSearchable(): bool
    {
        return true;
    }

    public function isSortable(): bool
    {
        return true;
    }
}
