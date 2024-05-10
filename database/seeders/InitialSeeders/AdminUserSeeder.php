<?php

namespace Database\Seeders\InitialSeeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@prettytours.net',
            'name' => 'admin',
            'password' => bcrypt('password'),
        ]);
        $admin->assignRole('admin');
    }
}
