<?php

namespace App\Filament\Employee\Resources;

use App\Filament\Components\PartnerTextColumn;
use App\Filament\Components\StatusTextColumn;
use App\Filament\Employee\Resources\VipServiceBookingResource\Pages;
use App\Models\Booking;
use App\Models\VipService;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

//use App\Filament\Employee\Resources\VipServiceBookingResource\RelationManagers;

class VipServiceBookingResource extends BookingResource
{
    protected static ?string $model = Booking::class;

    protected static ?string $bookable = VipService::class;

    protected static ?int $navigationSort = 1 + 10;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return parent::table($table)
            ->columns([
                TextColumn::make('user.name')
                    ->label('User')
                    ->sortable(),
                TextColumn::make('bookable.title')
                    ->label('VIP service'),
                TextColumn::make('date')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('phone')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('guests_count')
                    ->numeric(),
                PartnerTextColumn::make('partner.user.name'),
                StatusTextColumn::make('status'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVipServiceBookings::route('/'),
            'create' => Pages\CreateVipServiceBooking::route('/create'),
            'edit' => Pages\EditVipServiceBooking::route('/{record}/edit'),
        ];
    }
}
