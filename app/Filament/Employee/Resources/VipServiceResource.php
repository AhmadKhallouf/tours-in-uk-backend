<?php

namespace App\Filament\Employee\Resources;

use App\Filament\Employee\Resources\VipServiceResource\Pages;
use App\Models\VipService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;

//use App\Filament\Employee2\Resources\VipServiceResource\RelationManagers;

class VipServiceResource extends ServiceResource
{
    protected static ?string $model = VipService::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';

    protected static ?int $navigationSort = 0 + 10;

    public static function getNavigationGroup(): ?string
    {
        return VipServiceResource::getTitleCasePluralModelLabel();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\DatePicker::make('first_day'),
                Forms\Components\DatePicker::make('last_day'),
                Forms\Components\TextInput::make('price')
                    ->numeric()
                    ->required(),
                Forms\Components\Toggle::make('is_available')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->canWrap(),
                Tables\Columns\TextColumn::make('first_day')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('last_day')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->money(config('GBP')),
                Tables\Columns\IconColumn::make('is_available')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListVipServices::route('/'),
            'create' => Pages\CreateVipService::route('/create'),
            'edit' => Pages\EditVipService::route('/{record}/edit'),
        ];
    }
}
