<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\User;
use App\Models\Property;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if we have users and properties
        if (User::where('role', 'guest')->count() === 0) {
            User::factory()->count(5)->guest()->create();
        }

        if (Property::count() === 0) {
            Property::factory()->count(10)->create();
        }

        $guests = User::where('role', 'guest')->get();
        $properties = Property::all();

        // Create past bookings (completed)
        Booking::factory()->count(15)->confirmed()->create([
            'user_id' => function() use ($guests) {
                return $guests->random()->id;
            },
            'property_id' => function() use ($properties) {
                return $properties->random()->id;
            },
        ])->each(function ($booking) {
            $checkIn = Carbon::now()->subDays(rand(30, 90));
            $checkOut = $checkIn->copy()->addDays(rand(1, 14));
            
            $nights = $checkIn->diffInDays($checkOut);
            $property = Property::find($booking->property_id);
            $totalPrice = $nights * $property->price_per_night;

            $booking->update([
                'check_in' => $checkIn,
                'check_out' => $checkOut,
                'total_price' => $totalPrice,
            ]);
        });

        // Create current bookings (ongoing)
        Booking::factory()->count(5)->confirmed()->create([
            'user_id' => function() use ($guests) {
                return $guests->random()->id;
            },
            'property_id' => function() use ($properties) {
                return $properties->random()->id;
            },
        ])->each(function ($booking) {
            $checkIn = Carbon::now()->subDays(rand(1, 3));
            $checkOut = $checkIn->copy()->addDays(rand(3, 7));
            
            $nights = $checkIn->diffInDays($checkOut);
            $property = Property::find($booking->property_id);
            $totalPrice = $nights * $property->price_per_night;

            $booking->update([
                'check_in' => $checkIn,
                'check_out' => $checkOut,
                'total_price' => $totalPrice,
            ]);
        });

        // Create upcoming bookings
        Booking::factory()->count(10)->create([
            'user_id' => function() use ($guests) {
                return $guests->random()->id;
            },
            'property_id' => function() use ($properties) {
                return $properties->random()->id;
            },
        ])->each(function ($booking) {
            $checkIn = Carbon::now()->addDays(rand(1, 30));
            $checkOut = $checkIn->copy()->addDays(rand(1, 14));
            
            $nights = $checkIn->diffInDays($checkOut);
            $property = Property::find($booking->property_id);
            $totalPrice = $nights * $property->price_per_night;

            $status = ['pending', 'confirmed'][array_rand(['pending', 'confirmed'])];

            $booking->update([
                'check_in' => $checkIn,
                'check_out' => $checkOut,
                'total_price' => $totalPrice,
                'status' => $status,
            ]);
        });

        // Create some cancelled bookings
        Booking::factory()->count(5)->cancelled()->create([
            'user_id' => function() use ($guests) {
                return $guests->random()->id;
            },
            'property_id' => function() use ($properties) {
                return $properties->random()->id;
            },
        ]);

        $this->command->info('Created bookings: 15 past, 5 current, 10 upcoming, 5 cancelled');
    }

    /**
     * Create demo bookings for specific users and properties.
     */
    public function createDemoBookings(): void
    {
        $demoGuest = User::where('email', 'guest@example.com')->first();
        $demoHost = User::where('email', 'host@example.com')->first();
        
        if ($demoGuest && $demoHost) {
            $hostProperties = Property::where('user_id', $demoHost->id)->get();
            
            if ($hostProperties->isNotEmpty()) {
                // Create confirmed booking
                Booking::factory()->confirmed()->create([
                    'user_id' => $demoGuest->id,
                    'property_id' => $hostProperties->first()->id,
                ])->update([
                    'check_in' => Carbon::now()->addDays(7),
                    'check_out' => Carbon::now()->addDays(10),
                    'total_price' => 3 * $hostProperties->first()->price_per_night,
                ]);

                // Create pending booking
                Booking::factory()->pending()->create([
                    'user_id' => $demoGuest->id,
                    'property_id' => $hostProperties->last()->id,
                ])->update([
                    'check_in' => Carbon::now()->addDays(14),
                    'check_out' => Carbon::now()->addDays(17),
                    'total_price' => 3 * $hostProperties->last()->price_per_night,
                ]);
            }
        }
    }
}