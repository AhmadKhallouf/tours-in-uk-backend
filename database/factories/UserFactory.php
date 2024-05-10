<?php

namespace Database\Factories;

use App\Enums\UserRole;
use App\Models\User;
use App\Services\UserService;
use Hash;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'phone' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$UP2HQeTlQv1yftar606vCuPvB2ebSsFqi/47IHFF1rgZKvct43vBS', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return $this
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Assign 'client' role to the user.
     *
     * @return $this
     */
    public function client(): static
    {
        return $this->afterCreating(function (User $user) {
            $user->assignRole(UserRole::CLIENT->value);
        });
    }

    public function withProfile(): static
    {
        return $this->afterCreating(function (User $user) {
            $user->profile()->create();
        });
    }
}
