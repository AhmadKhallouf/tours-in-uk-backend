<?php

namespace App\Filament\Employee\Resources;

use App\Enums\UserRole;
use App\Filament\Components\BaseResource;
use App\Filament\Components\BaseUserResource;
use App\Filament\Employee\Resources\ClientResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Parent_;

//use App\Filament\Employee2\Resources\ClientResource\RelationManagers;

class ClientResource extends BaseUserResource
{
    protected static ?string $model = User::class;

    protected static ?string $role = UserRole::CLIENT->value;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return parent::creationForm($form);
    }

    public static function canCreate(): bool
    {
        return false;
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
