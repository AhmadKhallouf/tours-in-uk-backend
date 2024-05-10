<?php

namespace App\Filament\Employee\Resources;

use App\Filament\Employee\Resources\VipServicesPageResource\Pages;
use App\Filament\Employee\Resources\VipServicesPageResource\RelationManagers;
use App\Models\VipServicesPage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VipServicesPageResource extends ContentResource
{
    protected static ?string $model = VipServicesPage::class;

    protected static ?int $navigationSort = 2 + 10;

    public static function getNavigationGroup(): ?string
    {
        return VipServiceResource::getNavigationGroup();
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
            'index' => Pages\ListVipServicesPages::route('/'),
            'create' => Pages\CreateVipServicesPage::route('/create'),
            'edit' => Pages\EditVipServicesPage::route('/{record}/edit'),
        ];
    }
}
