<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Amenity;

class AmenitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $amenities = [
            // Basic Amenities
            'WiFi',
            'Air Conditioning',
            'Heating',
            'Kitchen',
            'Washer',
            'Dryer',
            'Parking',
            
            // Entertainment
            'TV',
            'Cable TV',
            'Netflix',
            'Sound System',
            'Board Games',
            'Books',
            
            // Outdoor
            'Swimming Pool',
            'Hot Tub',
            'BBQ Grill',
            'Fire Pit',
            'Patio',
            'Balcony',
            'Garden',
            'Deck',
            
            // Safety & Accessibility
            'Security System',
            'Smoke Detector',
            'Carbon Monoxide Detector',
            'First Aid Kit',
            'Fire Extinguisher',
            'Wheelchair Accessible',
            'Elevator',
            
            // Family & Pet
            'Pet Friendly',
            'Child Friendly',
            'Baby Crib',
            'High Chair',
            'Toys',
            
            // Luxury
            'Gym',
            'Sauna',
            'Steam Room',
            'Concierge',
            'Daily Cleaning',
            'Breakfast Included',
            
            // Business
            'Dedicated Workspace',
            'Printer',
            'Scanner',
            'Meeting Room',
            
            // Eco-Friendly
            'Solar Panels',
            'Rainwater Harvesting',
            'Electric Vehicle Charger',
            'Composting',
            
            // Recreational
            'Bicycles',
            'Kayaks',
            'Beach Equipment',
            'Hiking Gear',
            'Ski Storage',
        ];

        foreach ($amenities as $amenity) {
            Amenity::create([
                'name' => $amenity,
            ]);
        }

        // Alternatively, you can use the factory for random amenities
        // Amenity::factory()->count(20)->create();
    }
}