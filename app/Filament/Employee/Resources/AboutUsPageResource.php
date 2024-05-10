<?php

namespace App\Filament\Employee\Resources;

use App\Filament\Employee\Resources\AboutUsPageResource\Pages;
use App\Filament\Employee\Resources\AboutUsPageResource\RelationManagers;
use App\Models\AboutUsPage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;

class AboutUsPageResource extends ContentResource
{
    protected static ?string $model = AboutUsPage::class;

    protected static ?string $navigationIcon = 'heroicon-o-information-circle';

    protected static ?int $navigationSort = 1 + 30;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title_1')
                    ->required()
                    ->maxLength(255),
                Forms\Components\MarkdownEditor::make('paragraph_1')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('image_1')
                    ->image()
                    ->required(),
                Forms\Components\TextInput::make('title_2')
                    ->required()
                    ->maxLength(255),
                Forms\Components\MarkdownEditor::make('paragraph_2')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('highlight_box_2')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('image_2_1')
                    ->image()
                    ->required(),
                Forms\Components\FileUpload::make('image_2_2')
                    ->image()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title_1')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image_1'),
                Tables\Columns\TextColumn::make('title_2')
                    ->searchable(),
                Tables\Columns\TextColumn::make('highlight_box_2')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image_2_1'),
                Tables\Columns\ImageColumn::make('image_2_2'),
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
            'index' => Pages\ListAboutUsPages::route('/'),
            'create' => Pages\CreateAboutUsPage::route('/create'),
            'edit' => Pages\EditAboutUsPage::route('/{record}/edit'),
        ];
    }
}
