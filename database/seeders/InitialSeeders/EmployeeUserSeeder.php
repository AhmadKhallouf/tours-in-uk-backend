<?php

namespace Database\Seeders\InitialSeeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class EmployeeUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employee = User::factory()->create([
            'email' => 'employee@prettytours.net',
            'name' => 'employee',
            'password' => bcrypt('password'),
        ]);
        $employee->assignRole('employee');
        $employee->givePermissionTo(Permission::all());
    }
}
