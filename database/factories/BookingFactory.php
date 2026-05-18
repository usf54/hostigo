<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Booking;
use App\Models\User;
use App\Models\Property;
use Carbon\Carbon;

class BookingFactory extends Factory
{
    public function definition(): array
    {
        $checkIn = $this->faker->dateTimeBetween('+1 days', '+30 days');
        $checkOut = Carbon::parse($checkIn)->addDays(rand(1, 14));

        return [
            'user_id' => User::where('role', 'guest')->inRandomOrder()->value('id'),
            'property_id' => Property::inRandomOrder()->value('id'),
            'check_in' => $checkIn,
            'check_out' => $checkOut,
            'status' => 'pending',
            'total_price' => 0, // calculated in seeder or state
        ];
    }

    public function pending(): static
    {
        return $this->state(fn () => ['status' => 'pending']);
    }

    public function confirmed(): static
    {
        return $this->state(fn () => ['status' => 'confirmed']);
    }

    public function cancelled(): static
    {
        return $this->state(fn () => ['status' => 'cancelled']);
    }

    public function forUser(User $user): static
    {
        return $this->state(fn () => [
            'user_id' => $user->id,
        ]);
    }

    public function forProperty(Property $property): static
    {
        return $this->state(fn (array $attributes) => [
            'property_id' => $property->id,
        ]);
    }

    public function withDates($checkIn, $checkOut, Property $property): static
    {
        $nights = Carbon::parse($checkIn)->diffInDays($checkOut);

        return $this->state(fn () => [
            'check_in' => $checkIn,
            'check_out' => $checkOut,
            'total_price' => $nights * $property->price_per_night,
        ]);
    }
}