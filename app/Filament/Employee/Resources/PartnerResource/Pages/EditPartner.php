<?php

namespace App\Filament\Employee\Resources\PartnerResource\Pages;

use App\Filament\Components\CommissionPercentageTextInput;
use App\Filament\Employee\Resources\PartnerResource;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;

class EditPartner extends EditRecord
{
    protected static string $resource = PartnerResource::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Toggle::make('is_active'),
                CommissionPercentageTextInput::make('commission_percentage'),
            ]);
    }
}
