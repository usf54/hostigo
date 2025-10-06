<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center px-4 bg-gray-100">
        <div class="bg-white w-full max-w-lg rounded-xl shadow-md border border-gray-100 overflow-hidden">

            {{-- Header --}}
            <div class="text-center py-10 px-6">
                <h1 class="text-3xl font-bold text-black font-['Raleway']">You’ve Got a New Booking 📩</h1>
            </div>

            {{-- Body --}}
            <div class="px-8 py-10 text-gray-700">
                <h2 class="text-2xl font-bold mb-4">Hello {{ $booking->property->host->name }},</h2>
                <p class="mb-4 text-base leading-relaxed">
                    You have received a new booking for your property. Here are the details:
                </p>

                <div class="bg-gray-50 p-6 rounded-lg mb-6 text-gray-800">
                    <p class="mb-2"><span class="font-semibold">Property:</span> {{ $booking->property->title }}</p>
                    <p class="mb-2"><span class="font-semibold">Guest:</span> {{ $booking->guest->name }}</p>
                    <p class="mb-2"><span class="font-semibold">Check-in:</span> {{ $booking->check_in }}</p>
                    <p class="mb-2"><span class="font-semibold">Check-out:</span> {{ $booking->check_out }}</p>
                    <p class="mb-0"><span class="font-semibold">Total Price:</span> ${{ number_format($booking->total_price, 2) }}</p>
                </div>

                <div class="text-center">
                    <a href="{{ route('host.bookings.show', $booking->id) }}"
                       class="bg-red-600 hover:bg-red-700 text-white font-semibold rounded-full px-8 py-3 inline-block transition-colors">
                       Manage Booking
                    </a>
                </div>
            </div>

            {{-- Footer --}}
            <div class="bg-gray-100 text-center py-4 text-sm text-gray-500">
                <p class="mb-0">© {{ date('Y') }} Hostigo. All rights reserved.</p>
            </div>

        </div>
    </div>
</x-guest-layout>
