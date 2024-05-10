<?php

namespace App\Filament\Components;

use Filament\Tables\Columns\TextColumn;
use Illuminate\Contracts\Support\Htmlable;

class CommissionPercentageTextColumn extends TextColumn
{
    public function getSuffix(): string|Htmlable|null
    {
        return '%';
    }

    /**
     * @return bool
     */
    public function isNumeric(): bool
    {
        return true;
    }

    /**
     * @return bool
     */
    public function isSortable(): bool
    {
        return true;
    }
}
