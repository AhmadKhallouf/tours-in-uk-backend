<?php

namespace App\Filament\Employee\Resources;

use App\Filament\Employee\Resources\CoachToursPageResource\Pages;
use App\Models\CoachToursPage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;

class CoachToursPageResource extends ContentResource
{
    protected static ?string $model = CoachToursPage::class;

    protected static ?int $navigationSort = 2 + 20;

    public static function getNavigationGroup(): ?string
    {
        return CoachTourResource::getNavigationGroup();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('hero_title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('hero_description')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('box_image')
                    ->image()
                    ->required(),
                Forms\Components\Textarea::make('box_text')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('services_box_title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('services_box_description')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('hero_title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('hero_description')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('box_image'),
                Tables\Columns\TextColumn::make('services_box_title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('services_box_description')
                    ->searchable(),
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
            'index' => Pages\ListCoachToursPages::route('/'),
            'create' => Pages\CreateCoachToursPage::route('/create'),
            'edit' => Pages\EditCoachToursPage::route('/{record}/edit'),
        ];
    }
}
