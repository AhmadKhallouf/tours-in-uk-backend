<?php

namespace Database\Seeders\TestSeeders;

use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        Vehicle::factory()
            ->count(5)
            ->create();
    }
}
