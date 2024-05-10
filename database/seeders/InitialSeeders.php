<?php

namespace Database\Seeders;

use Database\Seeders\InitialSeeders\AdminUserSeeder;
use Database\Seeders\InitialSeeders\Content\AboutUsPageSeeder;
use Database\Seeders\InitialSeeders\Content\ContactSectionSeeder;
use Database\Seeders\InitialSeeders\Content\ContactUsPageSeeder;
use Database\Seeders\InitialSeeders\Content\HomePageSeeder;
use Database\Seeders\InitialSeeders\EmployeeUserSeeder;
use Database\Seeders\InitialSeeders\PermissionSeeder;
use Database\Seeders\InitialSeeders\RoleSeeder;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class InitialSeeders extends Seeder
{
    public function run(): void
    {
        // Define roles and permissions
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);

        // Create an admin and an employee
        $this->call(AdminUserSeeder::class);
        $this->call(EmployeeUserSeeder::class);

        // Seed initial content
        $this->call(ContactSectionSeeder::class);
        $this->call(HomePageSeeder::class);
        $this->call(AboutUsPageSeeder::class);
        $this->call(ContactUsPageSeeder::class);
    }
}
