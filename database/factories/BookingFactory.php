<?php

namespace Database\Factories;

use App\Enums\PADStatus;
use App\Models\Vehicle;
use App\Models\CoachTour;
use App\Models\Driver;
use App\Models\Tour;
use App\Models\User;
use App\Models\VipService;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $tour = Tour::factory()->create();
        $vipService = VipService::factory()->create();
        $coachTour = CoachTour::factory()->create();

        $bookable = $this->faker->randomElement([$tour, $vipService, $coachTour]);

        if ($bookable->first_day && $bookable->last_day) {
            $date = $this->faker->dateTimeBetween($bookable->first_day, $bookable->last_day);
        } else if ($bookable->date) {
            $date = $bookable->date;
        } else {
            $date = $this->faker->dateTimeBetween(now()->startOfMonth(), now()->endOfMonth());
        }

        $guestsCount = $this->faker->numberBetween(1, 10);
        $price = $bookable->price ?? 10;
        return [
            'user_id' => User::factory()->create()->id,
            'bookable_type' => $bookable::class,
            'bookable_id' => $bookable->id,

            'date' => $date,
            'name' => $this->faker->name,
            'phone' => $this->faker->phoneNumber,
            'guests_count' => $guestsCount,
            'message' => $this->faker->text,
            'destination' => $this->faker->city,
            'vehicle_id' => Vehicle::factory(),
            'driver_id' => Driver::factory(),
            'price_per_guest' => $price,
            'net_profit' => $price * $guestsCount,
            'payment_status' => $this->faker->randomElement(array_map(fn($case) => $case->value, PADStatus::cases())),
            'created_at' => $this->faker->dateTimeBetween(now()->startOfYear(), now()->endOfYear()),
        ];
    }

    public function forUser(User $user): self
    {
        return $this->state(fn(array $attributes) => ['user_id' => $user->id]);
    }
}
