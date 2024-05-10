<?php

namespace App\Filament\Components;

use Closure;
use Filament\Forms\Components\TextInput;
use Illuminate\Contracts\Support\Htmlable;

class CommissionPercentageTextInput extends TextInput
{
    public function isNumeric(): bool
    {
        return true;
    }

    public function getMaxValue(): float
    {
        return 99;
    }

    public function getMinValue(): float
    {
        return 0.1;
    }

    public function getStep(): int|float|string|null
    {
        return 1;
    }

    public function getSuffixLabel(): string|Htmlable|null
    {
        return '%';
    }

    public function isRequired(): bool
    {
        return true;
    }
}
