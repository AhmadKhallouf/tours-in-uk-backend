<?php

namespace Database\Seeders\InitialSeeders\Content;

use App\Models\AboutUsPage;
use App\Services\RandImageProviderService;
use Illuminate\Database\Seeder;

class AboutUsPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws \Exception
     */
    public function run(): void
    {
        AboutUsPage::create([
            'title_1' => 'Your peace of mind, our priority',
            'paragraph_1' => 'Embark on a journey where tranquility and adventure go hand in hand. Pretty Tours is dedicated to creating travel experiences that resonate with comfort and excitement, ensuring your peace of mind is at the forefront of every trip.',
            'image_1' => RandImageProviderService::getRandomImage(), // Replace with actual path to image

            'title_2' => 'About Us',
            'paragraph_2' => 'Discover the world with Pretty Tours, where each itinerary is a blend of authentic encounters and unparalleled service. Our local experts craft each tour meticulously, guaranteeing an intimate glimpse into the heart of every destination.',
            'highlight_box_2' => 'We strive to offer you the best possible homes to stay.',
            'image_2_1' => RandImageProviderService::getRandomImage(), // Replace with actual path to first image
            'image_2_2' => RandImageProviderService::getRandomImage(), // Replace with actual path to second image

            'contact_section_id' => 1 // This should be the ID that links to your contact section details
        ]);
    }
}
