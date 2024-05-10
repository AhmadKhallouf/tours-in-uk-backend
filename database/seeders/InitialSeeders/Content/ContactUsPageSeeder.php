<?php

namespace Database\Seeders\InitialSeeders\Content;

use App\Models\ContactUsPage;
use App\Models\Faq;
use App\Services\RandImageProviderService;
use Illuminate\Database\Seeder;

class ContactUsPageSeeder extends Seeder
{
    /**
     * @throws \Exception
     */
    public function run(): void
    {
        $page = ContactUsPage::create([
            'hero_title' => 'Contact us',
            'hero_body' => "We're always here to answer your questions.\nReach out and we'll get back to you as soon as possible.",

            'box_title' => 'Connect with us',
            'box_image' => RandImageProviderService::getRandomImage(),

            'contact_section_id' => 1,
        ]);

        // TODO: remove for production
        $page->faqs()->saveMany(
            Faq::factory()->count(6)->create(['contact_us_page_id' => $page->id])
        );
    }
}
