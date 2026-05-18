<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\User;
use App\Models\Property;
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure data exists
        if (User::where('role', 'guest')->count() === 0) {
            User::factory()->count(5)->guest()->create();
        }

        if (Property::count() === 0) {
            Property::factory()->count(10)->create();
        }

        $guests = User::where('role', 'guest')->pluck('id')->toArray();
        $properties = Property::all();

        /*
        |-----------------------------------------
        | PAST BOOKINGS
        |-----------------------------------------
        */
        Booking::factory()->count(15)->make()->each(function ($booking) use ($guests, $properties) {

            $property = $properties->random();

            $checkIn = Carbon::now()->subDays(rand(30, 90));
            $checkOut = (clone $checkIn)->addDays(rand(1, 14));

            $booking->fill([
                'user_id' => $guests[array_rand($guests)],
                'property_id' => $property->id,
                'check_in' => $checkIn,
                'check_out' => $checkOut,
                'total_price' => $checkIn->diffInDays($checkOut) * $property->price_per_night,
                'status' => 'confirmed',
            ])->save();
        });

        /*
        |-----------------------------------------
        | CURRENT BOOKINGS
        |-----------------------------------------
        */
        Booking::factory()->count(5)->make()->each(function ($booking) use ($guests, $properties) {

            $property = $properties->random();

            $checkIn = Carbon::now()->subDays(rand(1, 3));
            $checkOut = (clone $checkIn)->addDays(rand(3, 7));

            $booking->fill([
                'user_id' => $guests[array_rand($guests)],
                'property_id' => $property->id,
                'check_in' => $checkIn,
                'check_out' => $checkOut,
                'total_price' => $checkIn->diffInDays($checkOut) * $property->price_per_night,
                'status' => 'confirmed',
            ])->save();
        });

        /*
        |-----------------------------------------
        | UPCOMING BOOKINGS
        |-----------------------------------------
        */
        Booking::factory()->count(10)->make()->each(function ($booking) use ($guests, $properties) {

            $property = $properties->random();

            $checkIn = Carbon::now()->addDays(rand(1, 30));
            $checkOut = (clone $checkIn)->addDays(rand(1, 14));

            $booking->fill([
                'user_id' => $guests[array_rand($guests)],
                'property_id' => $property->id,
                'check_in' => $checkIn,
                'check_out' => $checkOut,
                'total_price' => $checkIn->diffInDays($checkOut) * $property->price_per_night,
                'status' => collect(['pending', 'confirmed'])->random(),
            ])->save();
        });

        /*
        |-----------------------------------------
        | CANCELLED BOOKINGS
        |-----------------------------------------
        */
        Booking::factory()->count(5)->make()->each(function ($booking) use ($guests, $properties) {

            $property = $properties->random();

            $checkIn = Carbon::now()->addDays(rand(1, 20));
            $checkOut = (clone $checkIn)->addDays(rand(1, 10));

            $booking->fill([
                'user_id' => $guests[array_rand($guests)],
                'property_id' => $property->id,
                'check_in' => $checkIn,
                'check_out' => $checkOut,
                'total_price' => $checkIn->diffInDays($checkOut) * $property->price_per_night,
                'status' => 'cancelled',
            ])->save();
        });

        $this->command->info('Bookings seeded successfully');
    }
}