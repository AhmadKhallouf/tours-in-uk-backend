<?php

namespace App\Filament\Admin\Resources\EmployeeResource\Pages;

use App\Filament\Admin\Resources\EmployeeResource;
use App\Filament\Components\BaseUserResource;
use App\Filament\Components\PermissionSelect;
use Filament\Actions;
use Filament\Forms\Form;
use Filament\Forms;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasPermissions;
use Throwable;

class EditEmployee extends EditRecord
{
    protected static string $resource = EmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function form(Form $form): Form
    {
        return self::$resource::editForm($form);
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        if (array_key_exists('permissions', $data)) {
            $record->syncPermissions($data['permissions']);
        }
        return parent::handleRecordUpdate($record, $data);
    }
}
