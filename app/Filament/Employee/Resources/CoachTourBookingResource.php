<?php

namespace App\Filament\Employee\Resources;

use App\Filament\Components\PartnerTextColumn;
use App\Filament\Components\StatusTextColumn;
use App\Filament\Employee\Resources\CoachTourBookingResource\Pages;
use App\Models\Booking;
use App\Models\CoachTour;
use Filament\Forms\Form;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

//use App\Filament\Employee2\Resources\CoachTourBookingResource\RelationManagers;

class CoachTourBookingResource extends BookingResource
{

    protected static ?string $model = Booking::class;

    protected static ?string $bookable = CoachTour::class;

    protected static ?int $navigationSort = 1 + 20;

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
                    ->label('Coach tour'),
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
            'index' => Pages\ListCoachTourBookings::route('/'),
            'create' => Pages\CreateCoachTourBooking::route('/create'),
            'edit' => Pages\EditCoachTourBooking::route('/{record}/edit'),
        ];
    }
}
