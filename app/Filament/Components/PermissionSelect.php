<?php

namespace App\Filament\Components;

use App\Enums\UserRole;
use Closure;
use Doctrine\DBAL\Exception\DatabaseDoesNotExist;
use Filament\Forms\Components\Select;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Spatie\Permission\Models\Permission;
use Str;

class PermissionSelect extends Select
{
    public function isMultiple(): bool
    {
        return true;
    }

    public function getOptions(): array
    {
        $permissions = Permission::all();
        $permissionNames = $permissions->pluck('name')->toArray();
        $options = [];
        foreach ($permissionNames as $name) {
            $options[$name] =
                'Access ' .
                Str::ucfirst(
                    Str::snake(Str::camel($name), ' ')
                );
        }
        return $options;
    }

    public function isSearchable(): bool
    {
        return true;
    }
}
