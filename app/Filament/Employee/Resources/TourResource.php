<?php

namespace App\Filament\Employee\Resources;

use App\Filament\Employee\Pages\EditService;
use App\Filament\Employee\Resources\TourResource\Pages;
use App\Filament\Employee\Resources\TourResource\RelationManagers\BookingsRelationManager;
use App\Filament\Employee\Resources\TourResource\RelationManagers\EventsRelationManager;
use App\Filament\Employee\Resources\TourResource\RelationManagers\ImagesRelationManager;
use App\Models\Tour;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use function Laravel\Prompts\confirm;

class TourResource extends ServiceResource
{
    protected static ?string $model = Tour::class;

    protected static ?string $navigationIcon = 'heroicon-o-lifebuoy';

    protected static ?int $navigationSort = 0;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Textarea::make('description')
                    ->maxLength(65535)
                    ->columnSpanFull(),
                TextInput::make('location')
                    ->required()
                    ->maxLength(255),
                TextInput::make('environment')
                    ->required()
                    ->maxLength(255),
                TextInput::make('city')
                    ->maxLength(255),
                TextInput::make('check_in')
                    ->required(),
                TextInput::make('check_out')
                    ->required(),
                DatePicker::make('first_day')
                    ->required(),
                DatePicker::make('last_day')
                    ->required(),
                Toggle::make('is_available')
                    ->required(),
                TextInput::make('guests_count')
                    ->required()
                    ->numeric(),
                TextInput::make('price')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return parent::table($table)
            ->columns([
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('location')
                    ->searchable()
                    ->hidden(),
                TextColumn::make('environment')
                    ->searchable(),
                TextColumn::make('city')
                    ->searchable(),
                TextColumn::make('check_in')
                    ->time(),
                TextColumn::make('check_out')
                    ->time(),
                TextColumn::make('first_day')
                    ->date()
                    ->sortable(),
                TextColumn::make('last_day')
                    ->date()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_available')
                    ->boolean(),
                TextColumn::make('guests_count')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('price')
                    ->money('GBP'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //TODO: Add Activities relation manager
            EventsRelationManager::class,
            ImagesRelationManager::class,
            BookingsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTours::route('/'),
            'create' => Pages\CreateTour::route('/create'),
            'edit' => Pages\EditTour::route('/{record}/edit'),
        ];
    }
}
