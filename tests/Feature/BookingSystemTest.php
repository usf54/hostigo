<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Booking;
use App\Models\Property;
use App\Models\Payment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingConfirmationMail;
use App\Mail\NewBookingNotificationMail;
use App\Mail\GuestCancelledBookingMail;
use Carbon\Carbon;

class BookingSystemTest extends TestCase
{
    use RefreshDatabase;

    #[\PHPUnit\Framework\Attributes\Test]
    public function a_guest_can_create_a_booking()
    {
        Mail::fake();

        $guest = User::factory()->guest()->create();
        $property = Property::factory()->create(['max_guests' => 4, 'price_per_night' => 100]);

        $checkIn = Carbon::now()->addDays(2)->format('Y-m-d');
        $checkOut = Carbon::now()->addDays(5)->format('Y-m-d');

        $response = $this->actingAs($guest)->post(route('bookings.store', $property), [
            'check_in' => $checkIn,
            'check_out' => $checkOut,
            'guests' => 2,
        ]);

        $response->assertRedirect(); // Redirects to booking.show
        $this->assertDatabaseHas('bookings', [
            'user_id' => $guest->id,
            'property_id' => $property->id,
            'status' => 'pending',
        ]);

        // Check total price calculation
        $booking = Booking::first();
        $this->assertEquals(3 * 100, $booking->total_price);

        Mail::assertQueued(BookingConfirmationMail::class);
        Mail::assertQueued(NewBookingNotificationMail::class);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function a_guest_cannot_book_overlapping_dates()
    {
        $guest = User::factory()->guest()->create();
        $property = Property::factory()->create(['max_guests' => 4]);

        $existingBooking = Booking::factory()->confirmed()->forUser($guest)->forProperty($property)->create([
            'check_in' => Carbon::now()->addDays(3),
            'check_out' => Carbon::now()->addDays(6),
        ]);

        $response = $this->actingAs($guest)->post(route('bookings.store', $property), [
            'check_in' => Carbon::now()->addDays(4)->format('Y-m-d'),
            'check_out' => Carbon::now()->addDays(7)->format('Y-m-d'),
            'guests' => 2,
        ]);

        $response->assertSessionHasErrors('check_in');
        $this->assertEquals(1, Booking::count());
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function a_guest_can_cancel_a_pending_booking()
    {
        Mail::fake();

        $guest = User::factory()->guest()->create();
        $property = Property::factory()->create();

        $booking = Booking::factory()->pending()->forUser($guest)->forProperty($property)->create();

        $response = $this->actingAs($guest)->patch(route('guest.bookings.cancel', $booking));

        $response->assertRedirect(route('guest.bookings.index'));
        $this->assertDatabaseHas('bookings', [
            'id' => $booking->id,
            'status' => 'cancelled',
        ]);

        Mail::assertQueued(GuestCancelledBookingMail::class);
    }
}
