<x-guest-layout>
        <div class="bg-white w-full max-w-lg rounded-xl shadow-md border border-gray-100 overflow-hidden">
            {{-- Hero Image --}}
            <div class="flex justify-center py-6">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Hostigo Logo" class="w-36 h-36">
            </div>

            {{-- Body --}}
            <div class="px-8 pb-10 text-gray-700">
                <h2 class="text-2xl font-bold font-['Raleway'] mb-4">
                    Hello!
                </h2>
                <p class="leading-relaxed mb-4" style="font-color: red;">
                    Welcome to <span class="text-red-600 font-semibold">Hostigo</span>! We’re thrilled to have you join our travel community. 
                    Whether you're looking for your dream getaway or ready to host travelers from all over the world, 
                    we’ve got the perfect experience waiting for you.
                </p>
                <p class="text-base leading-relaxed mb-6">
                    Start exploring properties, manage your bookings, and plan unforgettable stays with ease.
                </p>

                <div class="text-center">
                    <a href="{{ url('/') }}" 
                       class="bg-red-600 hover:bg-red-700 text-white font-semibold rounded-full px-8 py-3 inline-block transition-colors">
                        Explore Hostigo
                    </a>
                </div>
            </div>

            {{-- Footer --}}
            <div class="bg-gray-100 text-center py-4 text-sm text-gray-500">
                <p class="mb-1">© {{ date('Y') }} Hostigo. All rights reserved.</p>
            </div>
    </div>
</x-guest-layout>
