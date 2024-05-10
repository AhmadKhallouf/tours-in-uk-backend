<?php

namespace Database\Seeders\TestSeeders;

use App\Models\Tour;
use Illuminate\Database\Seeder;

class TourSeeder extends Seeder
{
    public function run(): void
    {
        $factory = Tour::factory()
            ->withEvents()
            ->withImages()
            ->withActivities();

        $factory
            ->create([
                'first_day' => '2024-04-01',
                'last_day' => '2024-06-01',
            ]);

        $factory
            ->count(20)
            ->create();
    }
}
