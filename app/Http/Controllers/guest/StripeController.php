<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\Payment;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;

class StripeController extends Controller
{
    public function checkout(Booking $booking)
    {
        // Check if user owns the booking
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Check if booking is already paid
        if ($booking->isPaid()) {
            return redirect()->route('guest.bookings.show', $booking)
                ->with('error', 'This booking is already paid.');
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            // Create Stripe Checkout Session
            $checkout_session = Session::create([
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $booking->property->title,
                            'description' => 'Booking from ' . $booking->check_in . ' to ' . $booking->check_out,
                        ],
                        'unit_amount' => $this->calculateAmount($booking), // in cents
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('payment.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('payment.cancel'),
                'payment_intent_data' => [
                    'metadata' => [
                        'booking_id' => $booking->id,
                        'Property name' => $booking->property->title,
                        'User name' => Auth::user()->name,
                    ],
                ],
            ]);

            // Create or update payment record
            Payment::updateOrCreate(
                ['booking_id' => $booking->id],
                [
                    'amount' => $booking->total_price,
                    'payment_method' => 'stripe',
                    'status' => 'pending',
                    'stripe_payment_intent_id' => $checkout_session->payment_intent,
                    'stripe_client_secret' => $checkout_session->id,
                    'currency' => 'usd',
                    'metadata' => $checkout_session->metadata,
                ]
            );

            // Redirect to Stripe Checkout
            return redirect($checkout_session->url);

        } catch (ApiErrorException $e) {
            return redirect()->route('guest.bookings.show', $booking)
                ->with('error', 'Payment initialization failed: ' . $e->getMessage());
        }
    }

    public function paymentSuccess(Request $request)
    {
        $sessionId = $request->get('session_id');
        
        if (!$sessionId) {
            return redirect()->route('guest.bookings.index')
                ->with('error', 'Invalid payment confirmation.');
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $session = Session::retrieve($sessionId);
            $payment = Payment::where('stripe_client_secret', $sessionId)->first();

            if ($payment && $session->payment_status === 'paid') {
                // Update payment status
                $payment->update([
                    'status' => 'completed',
                    'transaction_id' => $session->payment_intent
                ]);

                // Update booking status
                $payment->booking->update(['status' => 'confirmed']);
                
                return redirect()->route('guest.bookings.show', $payment->booking)
                    ->with('success', 'Payment completed successfully! Your booking is now confirmed.');
            }

            return redirect()->route('guest.bookings.index')
                ->with('error', 'Payment failed or could not be verified.');

        } catch (ApiErrorException $e) {
            return redirect()->route('guest.bookings.index')
                ->with('error', 'Payment verification failed: ' . $e->getMessage());
        }
    }

    public function paymentCancel()
    {
        return redirect()->route('guest.bookings.index')
            ->with('info', 'Payment was cancelled. You can try again later.');
    }

    private function calculateAmount(Booking $booking)
    {
        // Calculate total amount in cents
        return (int) ($booking->total_price * 100);
    }
}