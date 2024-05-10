<?php

namespace Database\Seeders\TestSeeders;

use App\Models\CoachTour;
use Illuminate\Database\Seeder;

class CoachTourSeeder extends Seeder
{
    public function run(): void
    {
        CoachTour::factory()
            ->withImages()
            ->count(5)
            ->create();
    }
}
