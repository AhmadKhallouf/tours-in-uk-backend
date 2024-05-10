<?php

namespace Database\Seeders\TestSeeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    public function run(): void
    {
        Partner::factory()
            ->count(5)
            ->create();
    }
}
