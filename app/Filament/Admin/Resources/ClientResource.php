<?php

namespace App\Filament\Admin\Resources;

use App\Enums\UserRole;
use App\Filament\Admin\Resources\ClientResource\Pages;
use App\Filament\Components\BaseUserResource;
use App\Models\User;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Parent_;

//use App\Filament\Admin\Resources\ClientResource\RelationManagers;

class ClientResource extends BaseUserResource
{
    protected static ?string $model = User::class;

    protected static ?string $role = UserRole::CLIENT->value;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function canDelete(Model $record): bool
    {
        return true;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
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
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }
}
