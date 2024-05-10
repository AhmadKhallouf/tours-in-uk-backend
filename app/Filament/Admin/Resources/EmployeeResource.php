<?php

namespace App\Filament\Admin\Resources;

use App\Enums\UserRole;
use App\Filament\Admin\Resources\EmployeeResource\Pages;
use App\Filament\Components\BaseUserResource;
use App\Filament\Components\PermissionSelect;
use App\Models\User;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

//use App\Filament\Admin\Resources\EmployeeResource\RelationManagers;

class EmployeeResource extends BaseUserResource
{
    protected static ?string $model = User::class;

    protected static ?string $role = UserRole::EMPLOYEE->value;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    public static function canCreate(): bool
    {
        return true;
    }

    public static function canDelete(Model $record): bool
    {
        return true;
    }

    public static function form(Form $form): Form
    {
        return parent::creationForm($form);
    }

    public static function table(Table $table): Table
    {
        return parent::table($table);
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
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];

    }
}
