<?php

namespace App\Filament\Components;

use App\Enums\UserRole;
use App\Models\User;
use Filament\Forms\Form;
use Filament\Forms;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class BaseUserResource extends BaseResource
{
    protected static ?string $model = User::class;

    protected static ?string $role = null;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function creationForm(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('is_active')
                    ->required(),
                PermissionSelect::make('permissions')
                    ->hidden(static::$role != UserRole::EMPLOYEE->value),
            ]);
    }

    public static function editForm(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Toggle::make('is_active')
                    ->required(),
                PermissionSelect::make('permissions')
                    ->hidden(static::$role != UserRole::EMPLOYEE->value)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
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

    public static function getModelLabel(): string
    {
        return self::getCustomModelLabel(static::$role ?? 'user');
    }

    public static function getPluralModelLabel(): string
    {
        return self::getCustomPluralModelLabel(static::$role ?? 'user');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $model = self::getModel();

        if (is_null(static::$role)) {
            return $model::query();
        }
        return $model::role(static::$role);
    }

    public static function handleRecordCreation(array $data): Model
    {
        if (array_key_exists('password', $data)) {
            $data['password'] = bcrypt($data['password']);
        }
        $user = User::create($data);
        $user->assignRole(static::$role ?? UserRole::CLIENT->value);
        return $user;
    }
}
