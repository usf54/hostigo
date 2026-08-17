<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Amenity;

class AmenitySeeder extends Seeder
{
    public function run(): void
    {
        $amenities = [
            'WiFi',
            'Air Conditioning',
            'Heating',
            'Swimming Pool',
            'Parking',
            'Kitchen',
            'Washer',
            'Dryer',
            'TV',
            'Workspace',
            'Balcony',
            'Garden',
            'BBQ',
            'Fireplace',
            'Hot Tub',
            'Gym',
            'Beach Access',
            'Mountain View',
            'Lake View',
            'Ocean View',
            'Ski Access',
            'Elevator',
            'Security',
            'Pet Friendly',
        ];

        foreach ($amenities as $name) {
            Amenity::firstOrCreate([
                'name' => $name,
            ]);
        }
    }
}