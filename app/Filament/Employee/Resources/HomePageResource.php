<?php

namespace App\Filament\Employee\Resources;

use App\Filament\Employee\Resources\HomePageResource\Pages;
use App\Models\HomePage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;

//use App\Filament\Employee\Resources\HomePageResource\RelationManagers;

class HomePageResource extends ContentResource
{
    protected static ?string $model = HomePage::class;

    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static ?int $navigationSort = 0 + 30;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('tour_1_id')
                    ->relationship('tour1', 'title')
                    ->required(),
                Forms\Components\Select::make('tour_2_id')
                    ->relationship('tour2', 'title')
                    ->required(),
                Forms\Components\Select::make('tour_3_id')
                    ->relationship('tour3', 'title')
                    ->required(),
                Forms\Components\FileUpload::make('hero_image')
                    ->image()
                    ->required(),
                Forms\Components\TextInput::make('hero_title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('hero_body')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('tours_title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('tours_body')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('services_title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('services_body')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('services_image_1')
                    ->image()
                    ->required(),
                Forms\Components\FileUpload::make('services_image_2')
                    ->image()
                    ->required(),
                Forms\Components\FileUpload::make('services_image_3')
                    ->image()
                    ->required(),
                Forms\Components\TextInput::make('specialities_title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('speciality_title_1')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('speciality_subtitle_1')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('speciality_icon_1')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('speciality_title_2')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('speciality_subtitle_2')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('speciality_icon_2')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('speciality_title_3')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('speciality_subtitle_3')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('speciality_icon_3')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('join_title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('join_body')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('about_title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\MarkdownEditor::make('about_paragraph')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('about_highlight_box')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('about_image_1')
                    ->image()
                    ->required(),
                Forms\Components\FileUpload::make('about_image_2')
                    ->image()
                    ->required(),
                Forms\Components\TextInput::make('testimonials_title')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tour_1_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tour_2_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tour_3_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('hero_image'),
                Tables\Columns\TextColumn::make('hero_title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('hero_body')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tours_title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tours_body')
                    ->searchable(),
                Tables\Columns\TextColumn::make('services_title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('services_body')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('services_image_1'),
                Tables\Columns\ImageColumn::make('services_image_2'),
                Tables\Columns\ImageColumn::make('services_image_3'),
                Tables\Columns\TextColumn::make('specialities_title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('speciality_title_1')
                    ->searchable(),
                Tables\Columns\TextColumn::make('speciality_subtitle_1')
                    ->searchable(),
                Tables\Columns\TextColumn::make('speciality_icon_1')
                    ->searchable(),
                Tables\Columns\TextColumn::make('speciality_title_2')
                    ->searchable(),
                Tables\Columns\TextColumn::make('speciality_subtitle_2')
                    ->searchable(),
                Tables\Columns\TextColumn::make('speciality_icon_2')
                    ->searchable(),
                Tables\Columns\TextColumn::make('speciality_title_3')
                    ->searchable(),
                Tables\Columns\TextColumn::make('speciality_subtitle_3')
                    ->searchable(),
                Tables\Columns\TextColumn::make('speciality_icon_3')
                    ->searchable(),
                Tables\Columns\TextColumn::make('join_title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('join_body')
                    ->searchable(),
                Tables\Columns\TextColumn::make('about_title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('about_highlight_box')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('about_image_1'),
                Tables\Columns\ImageColumn::make('about_image_2'),
                Tables\Columns\TextColumn::make('testimonials_title')
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
            'index' => Pages\ListHomePages::route('/'),
            'create' => Pages\CreateHomePage::route('/create'),
            'edit' => Pages\EditHomePage::route('/{record}/edit'),
        ];
    }
}
