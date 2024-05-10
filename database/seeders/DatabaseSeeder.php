<?php

namespace Database\Seeders;

use Database\Seeders\InitialSeeders\AdminUserSeeder;
use Database\Seeders\InitialSeeders\EmployeeUserSeeder;
use Database\Seeders\InitialSeeders\RoleSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(InitialSeeders::class);

        // TODO: local dev
        $this->call(TestSeeders::class);
    }
}
