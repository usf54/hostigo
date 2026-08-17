<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Property;
use App\Models\PropertyImage;

class PropertyImageSeeder extends Seeder
{
    public function run(): void
    {
        $imageGroups = [
            'Beachfront Bungalow' => [
                'demo-beachfront-bungalow-1.jpg',
                'demo-beachfront-bungalow-2.jpg',
                'demo-beachfront-bungalow-3.jpg',
            ],

            'Desert Oasis Retreat' => [
                'demo-desert-oasis-1.jpg',
                'demo-desert-oasis-2.jpg',
                'demo-desert-oasis-3.jpg',
            ],

            'Garden Cottage' => [
                'demo-garden-cottage-1.jpg',
                'demo-garden-cottage-2.jpg',
                'demo-garden-cottage-3.jpg',
            ],

            'Historic Brownstone' => [
                'demo-historic-brownstone-1.jpg',
                'demo-historic-brownstone-2.jpg',
                'demo-historic-brownstone-3.jpg',
            ],

            'Lakeside Retreat' => [
                'demo-lakeside-retreat-1.jpg',
                'demo-lakeside-retreat-2.jpg',
                'demo-lakeside-retreat-3.jpg',
            ],

            'Luxury Oceanfront Villa' => [
                'demo-luxury-oceanfront-villa-1.jpg',
                'demo-luxury-oceanfront-villa-2.jpg',
                'demo-luxury-oceanfront-villa-3.jpg',
            ],

            'Modern Downtown Penthouse' => [
                'demo-modern-downtown-penthouse-1.jpg',
                'demo-modern-downtown-penthouse-2.jpg',
                'demo-modern-downtown-penthouse-3.jpg',
            ],

            'Mountain View Cabin' => [
                'demo-mountain-view-cabin-1.jpg',
                'demo-mountain-view-cabin-2.jpg',
                'demo-mountain-view-cabin-3.jpg',
            ],

            'Ski-In Ski-Out Chalet' => [
                'demo-ski-in-ski-out-chalet-1.jpg',
                'demo-ski-in-ski-out-chalet-2.jpg',
                'demo-ski-in-ski-out-chalet-3.jpg',
            ],

            'Urban Chic Studio' => [
                'demo-urban-chic-studio-1.jpg',
                'demo-urban-chic-studio-2.jpg',
                'demo-urban-chic-studio-3.jpg',
            ],
        ];

        foreach ($imageGroups as $propertyTitle => $images) {
            $property = Property::where('title', $propertyTitle)->first();

            if (!$property) {
                $this->command->warn(
                    "Property not found: {$propertyTitle}"
                );

                continue;
            }

            // Remove existing seeded images for this property
            $property->images()->delete();

            foreach ($images as $image) {
                $path = 'assets/images/demo-images/' . $image;

                if (!file_exists(public_path($path))) {
                    $this->command->warn("Demo image not found: {$path}");
                    continue;
                }

                PropertyImage::create([
                    'property_id' => $property->id,
                    'image_url' => $path,
                ]);
            }
        }
    }
}