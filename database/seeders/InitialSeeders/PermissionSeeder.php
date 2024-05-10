<?php

namespace Database\Seeders\InitialSeeders;

use App\Enums\UserRole;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'profits',

            'clients',
            'partners',

            'vehicles',
            'drivers',

            'contact_enquiries',

            'tours',
            'tour_bookings',

            'vip_services',
            'vip_service_bookings',
            'vip_services_page',

            'coach_tours',
            'coach_tour_bookings',
            'coach_tours_page',

            'home_page',
            'about_us_page',
            'contact_us_page',
            'contact_section',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
