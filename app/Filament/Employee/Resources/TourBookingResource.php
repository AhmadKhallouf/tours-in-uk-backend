<?php

namespace App\Filament\Employee\Resources;

use App\Enums\PADStatus;
use App\Filament\Components\PartnerTextColumn;
use App\Filament\Components\StatusTextColumn;
use App\Filament\Employee\Actions\ApproveAction;
use App\Filament\Employee\Actions\DeclineAction;
use App\Filament\Employee\Resources\TourBookingResource\Pages;
use App\Models\Booking;
use App\Models\Tour;
use Faker\Provider\Text;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use phpDocumentor\Reflection\Types\Parent_;

//use App\Filament\Employee\Resources\TourBookingResource\RelationManagers;

class TourBookingResource extends BookingResource
{
    protected static ?string $model = Booking::class;

    protected static ?string $bookable = Tour::class;

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

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
                    ->label('Tour'),
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
            'index' => Pages\ListTourBookings::route('/'),
            'create' => Pages\CreateTourBooking::route('/create'),
            'edit' => Pages\EditTourBooking::route('/{record}/edit'),
        ];
    }
}
