<?php

namespace Database\Seeders;

use App\Models\CoachTour;
use Database\Seeders\TestSeeders\BookingSeeder;
use Database\Seeders\TestSeeders\VehicleSeeder;
use Database\Seeders\TestSeeders\CoachTourSeeder;
use Database\Seeders\TestSeeders\DriverSeeder;
use Database\Seeders\TestSeeders\PartnerSeeder;
use Database\Seeders\TestSeeders\TourSeeder;
use Database\Seeders\TestSeeders\UserSeeder;
use Database\Seeders\TestSeeders\VipServiceSeeder;
use Illuminate\Database\Seeder;

class TestSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(PartnerSeeder::class);

        $this->call(TourSeeder::class);
        $this->call(VipServiceSeeder::class);
        $this->call(CoachTourSeeder::class);

        $this->call(VehicleSeeder::class);
        $this->call(DriverSeeder::class);

        $this->call(BookingSeeder::class);
    }
}
