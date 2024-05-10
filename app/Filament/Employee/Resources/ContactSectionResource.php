<?php

namespace App\Filament\Employee\Resources;

use App\Filament\Employee\Resources\ContactSectionResource\Pages;
use App\Models\ContactSection;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;

class ContactSectionResource extends ContentResource
{
    protected static ?string $model = ContactSection::class;

    protected static ?string $navigationIcon = 'heroicon-o-phone';

    protected static ?int $navigationSort = 3 + 30;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('connect_box_title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('address')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('facebook_link')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('youtube_link')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('whatsapp_link')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('other_link')
                    ->maxLength(255),
                Forms\Components\TextInput::make('form_title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('footer_image')
                    ->image()
                    ->required(),
                Forms\Components\Textarea::make('text_on_footer_image')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('footer_title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('footer_body')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('connect_box_title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('facebook_link')
                    ->searchable(),
                Tables\Columns\TextColumn::make('youtube_link')
                    ->searchable(),
                Tables\Columns\TextColumn::make('whatsapp_link')
                    ->searchable(),
                Tables\Columns\TextColumn::make('other_link')
                    ->searchable(),
                Tables\Columns\TextColumn::make('form_title')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('footer_image'),
                Tables\Columns\TextColumn::make('footer_title')
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
            'index' => Pages\ListContactSections::route('/'),
            'create' => Pages\CreateContactSection::route('/create'),
            'edit' => Pages\EditContactSection::route('/{record}/edit'),
        ];
    }
}
