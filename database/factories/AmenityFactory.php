<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Amenity>
 */
class AmenityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word(),
        ];
    }

    /**
     * Create amenities with common property amenities.
     */
    public function common(): static
    {
        $commonAmenities = [
            'WiFi',
            'Swimming Pool',
            'Parking',
            'Air Conditioning',
            'Heating',
            'Kitchen',
            'Washer',
            'Dryer',
            'TV',
            'Gym',
            'Hot Tub',
            'BBQ Grill',
            'Fireplace',
            'Balcony',
            'Garden',
            'Patio',
            'Security System',
            'Elevator',
            'Wheelchair Accessible',
            'Pet Friendly',
        ];

        return $this->state(function (array $attributes) use ($commonAmenities) {
            static $index = 0;
            return [
                'name' => $commonAmenities[$index++ % count($commonAmenities)],
            ];
        });
    }
}