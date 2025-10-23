<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Property;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph(3),
            'price_per_night' => $this->faker->numberBetween(50, 1000),
            'address' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'country' => $this->faker->country(),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'max_guests' => $this->faker->numberBetween(1, 10),
        ];
    }

    /**
     * Indicate that the property is expensive.
     */
    public function expensive(): static
    {
        return $this->state(fn (array $attributes) => [
            'price_per_night' => $this->faker->numberBetween(500, 2000),
        ]);
    }

    /**
     * Indicate that the property is affordable.
     */
    public function affordable(): static
    {
        return $this->state(fn (array $attributes) => [
            'price_per_night' => $this->faker->numberBetween(30, 100),
        ]);
    }

    /**
     * Indicate that the property has many guests capacity.
     */
    public function largeCapacity(): static
    {
        return $this->state(fn (array $attributes) => [
            'max_guests' => $this->faker->numberBetween(8, 20),
        ]);
    }
}