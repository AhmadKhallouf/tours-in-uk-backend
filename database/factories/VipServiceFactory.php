<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VipService>
 */
class VipServiceFactory extends ServiceFactory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = $this->faker;
        return [
            'title' => $faker->words(3, true),
            'description' => $faker->realText($maxNbChars = 200, $indexSize = 2),
            'first_day' => $this->faker->dateTimeBetween(now()->startOfMonth(), now()->startOfMonth()->addMonth()),
            'last_day' => $this->faker->dateTimeBetween(now()->startOfMonth()->addMonth(), now()->startOfMonth()->addMonths(2)),
            'price' => $this->faker->randomFloat(2, 10, 1000),
        ];
    }
}
