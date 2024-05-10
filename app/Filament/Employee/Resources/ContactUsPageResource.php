<?php

namespace App\Filament\Employee\Resources;

use App\Filament\Employee\Resources\ContactUsPageResource\Pages;

//use App\Filament\Employee\Resources\ContactUsPageResource\RelationManagers;
use App\Models\ContactUsPage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;

class ContactUsPageResource extends ContentResource
{
    protected static ?string $model = ContactUsPage::class;

    protected static ?string $navigationIcon = 'heroicon-o-phone';

    protected static ?int $navigationSort = 2 + 30;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('hero_title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('hero_body')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('box_title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('box_image')
                    ->image(),
                Forms\Components\Select::make('ContactUsPage')
                    ->relationship('contactSection', 'id')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('hero_title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('hero_body')
                    ->searchable(),
                Tables\Columns\TextColumn::make('box_title')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('box_image'),
                Tables\Columns\TextColumn::make('contactSection.id')
                    ->numeric()
                    ->sortable(),
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
            //TODO: Faqs relation manager
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContactUsPages::route('/'),
            'create' => Pages\CreateContactUsPage::route('/create'),
            'edit' => Pages\EditContactUsPage::route('/{record}/edit'),
        ];
    }
}
