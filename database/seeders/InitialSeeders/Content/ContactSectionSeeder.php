<?php

namespace Database\Seeders\InitialSeeders\Content;

use App\Models\ContactSection;
use App\Services\RandImageProviderService;
use Illuminate\Database\Seeder;

class ContactSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws \Exception
     */
    public function run(): void
    {
        ContactSection::create([
            'connect_box_title' => "Let's connect",
            'phone' => '+385 91 322 8444',
            'email' => 'info@prettytours.net',
            'address' => 'Prospekt Ltd Drazice 138, 51 000 Rijeka Croatia',
            'facebook_link' => 'link-to-facebook-page',
            'whatsapp_link' => 'link-to-whatsapp-account',
            'youtube_link' => 'link-to-youtube-page',

            'form_title' => "We'd love to hear from you",

            'footer_image' => RandImageProviderService::getRandomImage(),
            'text_on_footer_image' => "Luxury takes many forms nowadays, but one thing\ndoesn't change: luxury is about desire and the ability\nto create dreams.",

            'footer_title' => 'PRETTY TOURS',
            'footer_body' => 'We are the artisans of personalized British travel, crafting unique experiences that capture the essence of the UK’s heritage and contemporary charm, tailored for your unforgettable journey.'
        ]);
    }
}
