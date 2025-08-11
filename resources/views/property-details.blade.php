@extends('layouts.app')

@section('content')
<div class="container py-5">

    <!-- Property Title & Host -->
    <div class="mb-4">
        <h1 class="fw-bold">Modern Apartment in the City Center</h1>
        <p class="text-muted">Hosted by <strong>John Doe</strong></p>
    </div>

    <!-- Image Gallery -->
    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <img src="{{ asset('assets/apartments/ap1.jpg' ) }}" class="img-fluid rounded" alt="Main property image">
        </div>
        <div class="col-md-6">
            <div class="row g-3">
                <div class="col-6">
                    <img src="{{ asset('assets/apartments/ap2.jpg' ) }}" class="img-fluid rounded" alt="Property image">
                </div>
                <div class="col-6">
                    <img src="{{ asset('assets/apartments/ap3.jpg' ) }}" class="img-fluid rounded" alt="Property image">
                </div>
                <div class="col-6">
                    <img src="{{ asset('assets/apartments/ap2.jpg' ) }}" class="img-fluid rounded" alt="Property image">
                </div>
                <div class="col-6">
                    <img src="{{ asset('assets/apartments/ap3.jpg' ) }}" class="img-fluid rounded" alt="Property image">
                </div>
            </div>
        </div>
    </div>

    <!-- Property Info & Booking -->
    <div class="row">
        <div class="col-lg-8">
            <!-- Description -->
            <div class="mb-4">
                <h4>About this property</h4>
                <p>
                    This stylish apartment offers modern comfort in the heart of the city.
                    Just a short walk to cafes, shops, and public transport. Perfect for business
                    trips or city getaways.
                </p>
            </div>

            <!-- Features -->
            <div class="mb-4">
                <h4>Features</h4>
                <ul class="list-unstyled">
                    <li>🛏 2 Bedrooms</li>
                    <li>🛁 1 Bathroom</li>
                    <li>🍳 Fully Equipped Kitchen</li>
                    <li>📶 Free Wi-Fi</li>
                    <li>🚗 Free Parking</li>
                </ul>
            </div>

            <!-- Location -->
            <div>
                <h4>Location</h4>
                <div class="ratio ratio-16x9">
                  <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d22191.56214247635!2d-7.473025325565015!3d33.59125742114033!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e1!3m2!1sen!2sma!4v1754936910517!5m2!1sen!2sma" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                  
                </div>
            </div>
        </div>

        <!-- Booking Card -->
        <div class="col-lg-4">
            <div class="card shadow-sm p-3">
                <h4 class="fw-bold mb-2">$120 / night</h4>
                <div class="mb-3">
                    <label class="form-label">Check-in</label>
                    <input type="date" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Check-out</label>
                    <input type="date" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Guests</label>
                    <input type="number" class="form-control" min="1" value="1">
                </div>
                <button class="btn w-100" style="background-color: #FF385C; color: white;">
                    Reserve
                </button>
            </div>
        </div>
    </div>

</div>
@endsection
