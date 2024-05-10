<?php

namespace Database\Seeders\TestSeeders;

use App\Models\Booking;
use App\Models\Tour;
use App\Models\User;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        Booking::factory()
            ->create([
                'bookable_type' => Tour::class,
                'bookable_id' => 1,
                'date' => '2024-05-01',
                'guests_count' => 2,
            ]);

        $testUser = User::firstWhere('name', 'Test User');

        Booking::factory()
            ->count(20)
            ->forUser($testUser)
            ->create();

        Booking::factory()
            ->count(20)
            ->create();
    }
}
