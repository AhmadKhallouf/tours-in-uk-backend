<?php

namespace Database\Seeders\TestSeeders;

use App\Models\VipService;
use Illuminate\Database\Seeder;

class VipServiceSeeder extends Seeder
{
    public function run(): void
    {
        VipService::factory()
            ->count(5)
            ->withImages()
            ->create();
    }
}
