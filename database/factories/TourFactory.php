<?php

namespace Database\Factories;

use App\Models\Activity;
use App\Models\Event;
use App\Models\Tour;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tour>
 */
class TourFactory extends ServiceFactory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->words(3, true),
            'description' => $this->faker->paragraph,
            'location' => $this->faker->randomFloat() . ', ' . $this->faker->randomFloat(),
            'environment' => $this->faker->randomElement(['mountains', 'seaside', 'forest', 'desert']),
            'city' => $this->faker->city,
            'check_in' => $this->faker->time,
            'check_out' => $this->faker->time,
            'first_day' => $this->faker->dateTimeBetween(now()->startOfMonth(), now()->startOfMonth()->addMonth()),
            'last_day' => $this->faker->dateTimeBetween(now()->startOfMonth()->addMonth(), now()->startOfMonth()->addMonths(2)),
            'guests_count' => $this->faker->numberBetween(1, 10),
            'price' => $this->faker->randomFloat(2, 100, 1000),
        ];
    }

    public function withEvents(): TourFactory|Factory
    {
        return $this->afterCreating(function (Tour $tour) {
            Event::factory()
                ->count(5)
                ->create(['tour_id' => $tour->id]);
        });
    }

    public function withActivities(): self
    {
        return $this->afterCreating(function (Tour $tour) {
            Activity::factory()
                ->count(5)
                ->create(['tour_id' => $tour->id]);
        });
    }
}
