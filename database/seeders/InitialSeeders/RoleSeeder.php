<?php

namespace Database\Seeders\InitialSeeders;

use App\Enums\UserRole;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => UserRole::ADMIN->value]);
        Role::create(['name' => UserRole::EMPLOYEE->value]);
        Role::create(['name' => UserRole::CLIENT->value]);
    }
}
