<?php

namespace App\Filament\Admin\Resources\EmployeeResource\Pages;

use App\Enums\UserRole;
use App\Filament\Admin\Resources\EmployeeResource;
use App\Filament\Components\BaseUserResource;
use App\Filament\Components\CreateUser;
use App\Models\User;
use Filament\Actions;
use Filament\Forms\Form;
use Filament\Forms;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateEmployee extends CreateUser
{
    protected static string $resource = EmployeeResource::class;
}
