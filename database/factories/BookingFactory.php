<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Booking;
use App\Models\User;
use App\Models\Property;
use Carbon\Carbon;

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
        $checkIn = $this->faker->dateTimeBetween('+1 days', '+30 days');
        $checkOut = Carbon::parse($checkIn)->addDays(rand(1, 14));
        
        // Get a guest user (role = 'guest')
        $guest = User::where('role', 'guest')->inRandomOrder()->first() ?? User::factory()->guest()->create();
        
        // Get a random property
        $property = Property::inRandomOrder()->first() ?? Property::factory()->create();
        
        $nights = Carbon::parse($checkIn)->diffInDays($checkOut);
        $totalPrice = $nights * $property->price_per_night;

        return [
            'user_id' => $guest->id,
            'property_id' => $property->id,
            'check_in' => $checkIn,
            'check_out' => $checkOut,
            'total_price' => $totalPrice,
            'status' => $this->faker->randomElement(['pending', 'confirmed', 'cancelled']),
        ];
    }

    /**
     * Indicate that the booking is pending.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
        ]);
    }

    /**
     * Indicate that the booking is confirmed.
     */
    public function confirmed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'confirmed',
        ]);
    }

    /**
     * Indicate that the booking is cancelled.
     */
    public function cancelled(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'cancelled',
        ]);
    }

    /**
     * Set specific dates for the booking.
     */
    public function withDates($checkIn, $checkOut): static
    {
        return $this->state(function (array $attributes) use ($checkIn, $checkOut) {
            $property = Property::find($attributes['property_id']);
            $nights = Carbon::parse($checkIn)->diffInDays($checkOut);
            $totalPrice = $nights * $property->price_per_night;

            return [
                'check_in' => $checkIn,
                'check_out' => $checkOut,
                'total_price' => $totalPrice,
            ];
        });
    }

    /**
     * Create a booking for a specific user.
     */
    public function forUser(User $user): static
    {
        return $this->state(fn (array $attributes) => [
            'user_id' => $user->id,
        ]);
    }

    /**
     * Create a booking for a specific property.
     */
    public function forProperty(Property $property): static
    {
        return $this->state(function (array $attributes) use ($property) {
            $nights = Carbon::parse($attributes['check_in'])->diffInDays($attributes['check_out']);
            $totalPrice = $nights * $property->price_per_night;

            return [
                'property_id' => $property->id,
                'total_price' => $totalPrice,
            ];
        });
    }
}