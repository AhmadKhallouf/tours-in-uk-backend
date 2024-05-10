<?php

namespace Database\Factories;

use App\Services\RandImageProviderService;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Testimonial>
 */
class TestimonialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws \Exception
     */
    public function definition(): array
    {
        return [
            'home_page_id' => 1,
            'image' => RandImageProviderService::getRandomImage(),
            'content' => $this->faker->paragraph,
            'testifier' => $this->faker->name,
        ];
    }
}
