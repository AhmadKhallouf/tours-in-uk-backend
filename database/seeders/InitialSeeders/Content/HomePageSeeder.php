<?php

namespace Database\Seeders\InitialSeeders\Content;

use App\Http\Controllers\Api\RndImageController;
use App\Models\Activity;
use App\Models\HomePage;
use App\Models\Testimonial;
use App\Models\Tour;
use App\Services\RandImageProviderService;
use Database\Factories\ActivityFactory;
use Exception;
use Illuminate\Database\Seeder;

class HomePageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws Exception
     */
    public function run(): void
    {
        // This creates the default home page content
        $homePage = HomePage::create([
            'hero_title' => 'PRETTY TOURS',
            'hero_body' => 'Find & book personal and group trips with expert local guides. Enjoy unique experiences with real local people.',

            'tours_title' => 'Our Trending Tour Packages',
            'tours_body' => 'Take a Look at Our Most Popular & Trending Offers. We Want You to Enjoy A Lifetime Journey that Will Remain in Your Heart Forever.',

            'services_title' => 'OUR SERVICES',
            'services_body' => 'Pretty tours brings you quality when it comes to tour guides, transportation and accommodations. SERVICES.',
            'services_image_1' => RandImageProviderService::getRandomImage(),
            'services_image_2' => RandImageProviderService::getRandomImage(),
            'services_image_3' => RandImageProviderService::getRandomImage(),

            'specialities_title' => 'Our Properties Specialities',

            'speciality_title_1' => 'Guide Tours',
            'speciality_subtitle_1' => 'Experienced & knowledgeable',
            'speciality_icon_1' => 'icon-guide-tours.png',

            'speciality_title_2' => 'Religious Tours',
            'speciality_subtitle_2' => 'Spiritual & peaceful',
            'speciality_icon_2' => 'icon-religious-tours.png',

            'speciality_title_3' => 'Best Flights Options',
            'speciality_subtitle_3' => 'Comfortable & affordable',
            'speciality_icon_3' => 'icon-best-flights.png',

            'join_title' => 'Join the pretty tours family',
            'join_body' => 'We are looking for passionate travelers who love to explore. Become part of our family by joining us.',
            'join_image' => RandImageProviderService::class,

            'about_title' => 'About Us',
            'about_paragraph' => 'Create wonderful memories with our company. We make sure you get to explore and enjoy the beautiful world. From Asia, Europe to America, Africa and more. We are with you at every step of the way.',
            'about_highlight_box' => 'Best offers for new customers, up to 50% discount on first journey',
            'about_image_1' => RandImageProviderService::getRandomImage(),
            'about_image_2' => RandImageProviderService::getRandomImage(),

            'testimonials_title' => 'See What Our Clients Say About Us',

            'contact_section_id' => 1,
        ]);

        // Fill most popular tours
        $tours = Tour::factory()
            ->withEvents()
            ->withActivities()
            ->withImages()
            ->count(4)
            ->create();
        $homePage->tour1()->associate($tours[1]);
        $homePage->tour2()->associate($tours[2]);
        $homePage->tour3()->associate($tours[3]);


        // Fill hero images
        for ($i = 0; $i < 3; $i++) {
            $homePage->heroImages()->create(['link' => RandImageProviderService::getRandomImage()]);
        }

        // Fill user testimonials
        Testimonial::factory()
            ->count(3)
            ->create(['home_page_id' => 1]);

        $homePage->save();
    }
}
