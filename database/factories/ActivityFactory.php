<?php

namespace Database\Factories;

use App\Models\Tour;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Activity>
 */
class ActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tour_id' => Tour::factory()->create()->id,
            'title' => $this->faker->word,
            'description' => $this->faker->optional()->paragraph,
            'rating' => $this->faker->optional()->randomFloat(2, 0.0, 5.0),
            'count' => $this->faker->optional()->numberBetween(1, 100),
        ];
    }
}
