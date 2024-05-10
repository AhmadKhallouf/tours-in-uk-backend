<?php

namespace Database\Seeders\TestSeeders;

use App\Models\User;
use App\Services\UserService;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()
            ->client()
            ->withProfile()
            ->create([
                'name' => 'Test User',
                'email' => 'test@prettytours.net',
                'phone' => '1234567890',
            ]);

        User::factory()
            ->count(5)
            ->client()
            ->withProfile()
            ->create();
    }
}
