<x-guest-layout>
    <div class="card mx-auto my-5" style="max-width: 28rem;">
        {{-- Hero Image --}}
        <div class="d-flex justify-content-center py-4">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Hostigo Logo" class="img-fluid" style="width: 9rem; height: 9rem;">
        </div>

        {{-- Body --}}
        <div class="card-body text-dark">
            <h2 class="card-title fw-bold mb-3" style="font-family: 'Raleway', sans-serif;">
                Hello!
            </h2>
            <p class="mb-3">
                Welcome to <span class="text-danger fw-semibold" style="color: red;">Hostigo</span>! We’re thrilled to have you join our travel community. 
                Whether you're looking for your dream getaway or ready to host travelers from all over the world, 
                we’ve got the perfect experience waiting for you.
            </p>
            <p class="mb-4">
                Start exploring properties, manage your bookings, and plan unforgettable stays with ease.
            </p>

            <div class="text-center">
                <a href="{{ url('/') }}" class="btn btn-danger btn-lg rounded-pill px-4">
                    Explore Hostigo
                </a>
            </div>
        </div>

        {{-- Footer --}}
        <div class="card-footer text-center text-muted py-3 small">
            <p class="mb-0">© {{ date('Y') }} Hostigo. All rights reserved.</p>
        </div>
    </div>
</x-guest-layout>
