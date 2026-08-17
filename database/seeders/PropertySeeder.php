<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Property;
use App\Models\User;
use App\Models\Amenity;

class PropertySeeder extends Seeder
{
    public function run(): void
    {
        $hosts = User::where('role', 'host')->get();

        if ($hosts->isEmpty()) {
            $this->command->error('No hosts found. Run UserSeeder first.');
            return;
        }

        $amenities = Amenity::pluck('id', 'name');

        $properties = [
            [
                'title' => 'Beachfront Bungalow',
                'description' => 'A charming beachfront bungalow offering direct access to the beach, comfortable interiors, and beautiful ocean views. Perfect for a relaxing coastal getaway.',
                'price_per_night' => 145,
                'address' => 'Coastal Road',
                'city' => 'Agadir',
                'country' => 'Morocco',
                'latitude' => 30.4278,
                'longitude' => -9.5981,
                'max_guests' => 4,
                'host_index' => 0,
                'amenities' => [
                    'WiFi',
                    'Air Conditioning',
                    'Kitchen',
                    'Parking',
                    'Beach Access',
                    'Ocean View',
                ],
            ],

            [
                'title' => 'Desert Oasis Retreat',
                'description' => 'A peaceful desert retreat surrounded by dramatic landscapes. Enjoy a private oasis, traditional architecture, and unforgettable sunsets.',
                'price_per_night' => 120,
                'address' => 'Oasis Road',
                'city' => 'Merzouga',
                'country' => 'Morocco',
                'latitude' => 31.0994,
                'longitude' => -4.0122,
                'max_guests' => 6,
                'host_index' => 1,
                'amenities' => [
                    'WiFi',
                    'Air Conditioning',
                    'Parking',
                    'Garden',
                    'BBQ',
                ],
            ],

            [
                'title' => 'Garden Cottage',
                'description' => 'A cozy cottage surrounded by a beautiful private garden. A quiet and comfortable stay ideal for couples and small families.',
                'price_per_night' => 95,
                'address' => 'Garden Avenue',
                'city' => 'Rabat',
                'country' => 'Morocco',
                'latitude' => 34.0209,
                'longitude' => -6.8416,
                'max_guests' => 4,
                'host_index' => 2,
                'amenities' => [
                    'WiFi',
                    'Kitchen',
                    'Washer',
                    'Garden',
                    'Parking',
                ],
            ],

            [
                'title' => 'Historic Brownstone',
                'description' => 'A beautifully restored historic home combining classic architectural details with modern comforts in the heart of the city.',
                'price_per_night' => 180,
                'address' => 'Historic District',
                'city' => 'New York',
                'country' => 'United States',
                'latitude' => 40.7128,
                'longitude' => -74.0060,
                'max_guests' => 5,
                'host_index' => 3,
                'amenities' => [
                    'WiFi',
                    'Heating',
                    'Kitchen',
                    'Washer',
                    'Dryer',
                    'Workspace',
                ],
            ],

            [
                'title' => 'Lakeside Retreat',
                'description' => 'A peaceful lakeside retreat surrounded by nature. Relax by the water, enjoy the views, and escape the noise of the city.',
                'price_per_night' => 160,
                'address' => 'Lakeside Drive',
                'city' => 'Annecy',
                'country' => 'France',
                'latitude' => 45.8992,
                'longitude' => 6.1294,
                'max_guests' => 6,
                'host_index' => 4,
                'amenities' => [
                    'WiFi',
                    'Heating',
                    'Kitchen',
                    'Fireplace',
                    'Parking',
                    'Lake View',
                ],
            ],

            [
                'title' => 'Luxury Oceanfront Villa',
                'description' => 'An elegant oceanfront villa featuring spacious living areas, premium amenities, and spectacular views of the sea.',
                'price_per_night' => 420,
                'address' => 'Oceanfront Avenue',
                'city' => 'Marrakech',
                'country' => 'Morocco',
                'latitude' => 31.6295,
                'longitude' => -7.9811,
                'max_guests' => 10,
                'host_index' => 0,
                'amenities' => [
                    'WiFi',
                    'Air Conditioning',
                    'Swimming Pool',
                    'Kitchen',
                    'Parking',
                    'Gym',
                    'Ocean View',
                    'Security',
                ],
            ],

            [
                'title' => 'Modern Downtown Penthouse',
                'description' => 'A stylish downtown penthouse with modern interiors, panoramic city views, and everything needed for a comfortable urban stay.',
                'price_per_night' => 280,
                'address' => 'Downtown Avenue',
                'city' => 'Casablanca',
                'country' => 'Morocco',
                'latitude' => 33.5731,
                'longitude' => -7.5898,
                'max_guests' => 6,
                'host_index' => 1,
                'amenities' => [
                    'WiFi',
                    'Air Conditioning',
                    'Elevator',
                    'Workspace',
                    'Gym',
                    'Security',
                    'Balcony',
                ],
            ],

            [
                'title' => 'Mountain View Cabin',
                'description' => 'A warm mountain cabin surrounded by nature, offering spectacular mountain views and a cozy atmosphere for a peaceful escape.',
                'price_per_night' => 135,
                'address' => 'Mountain Road',
                'city' => 'Ifrane',
                'country' => 'Morocco',
                'latitude' => 33.5228,
                'longitude' => -5.1108,
                'max_guests' => 6,
                'host_index' => 2,
                'amenities' => [
                    'WiFi',
                    'Heating',
                    'Kitchen',
                    'Fireplace',
                    'Parking',
                    'Mountain View',
                ],
            ],

            [
                'title' => 'Ski-In Ski-Out Chalet',
                'description' => 'A comfortable ski chalet located directly beside the slopes, making it easy to enjoy a full day of winter activities.',
                'price_per_night' => 310,
                'address' => 'Mountain Resort',
                'city' => 'Chamonix',
                'country' => 'France',
                'latitude' => 45.9237,
                'longitude' => 6.8694,
                'max_guests' => 8,
                'host_index' => 3,
                'amenities' => [
                    'WiFi',
                    'Heating',
                    'Fireplace',
                    'Hot Tub',
                    'Parking',
                    'Mountain View',
                    'Ski Access',
                ],
            ],

            [
                'title' => 'Urban Chic Studio',
                'description' => 'A compact and stylish studio designed for travelers who want a comfortable base close to the best restaurants, shops, and attractions.',
                'price_per_night' => 85,
                'address' => 'Central District',
                'city' => 'Casablanca',
                'country' => 'Morocco',
                'latitude' => 33.5899,
                'longitude' => -7.6039,
                'max_guests' => 2,
                'host_index' => 4,
                'amenities' => [
                    'WiFi',
                    'Air Conditioning',
                    'Kitchen',
                    'Workspace',
                    'Elevator',
                    'Security',
                ],
            ],
        ];

        foreach ($properties as $data) {
            $host = $hosts[$data['host_index'] % $hosts->count()];

            $property = Property::updateOrCreate(
                [
                    'title' => $data['title'],
                ],
                [
                    'user_id' => $host->id,
                    'title' => $data['title'],
                    'description' => $data['description'],
                    'price_per_night' => $data['price_per_night'],
                    'address' => $data['address'],
                    'city' => $data['city'],
                    'country' => $data['country'],
                    'latitude' => $data['latitude'],
                    'longitude' => $data['longitude'],
                    'max_guests' => $data['max_guests'],
                ]
            );

            $amenityIds = collect($data['amenities'])
                ->map(fn ($name) => $amenities[$name] ?? null)
                ->filter()
                ->values()
                ->toArray();

            $property->amenities()->sync($amenityIds);
        }
    }
}