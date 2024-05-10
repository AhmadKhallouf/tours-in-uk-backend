<?php

namespace Database\Factories;

use App\Models\Tour;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tour_id' => Tour::factory(),
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(10),
            'accommodation' => $this->faker->randomElement([null, $this->faker->word]),
            'meals' => $this->faker->randomElement([null, $this->faker->word]),
            'order' => $this->faker->numberBetween(1, 100),
        ];
    }

}
