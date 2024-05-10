<?php

namespace Database\Seeders\TestSeeders;

use App\Models\Driver;
use Database\Factories\DriverFactory;
use Illuminate\Database\Seeder;

class DriverSeeder extends Seeder
{
    public function run(): void
    {
        Driver::factory()
            ->count(5)
            ->create();
    }
}
