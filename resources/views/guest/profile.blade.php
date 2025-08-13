@extends('layouts.app')

@section('content')
<style>
    :root {
        --primary-color: #FF385C;
    }

    .profile-container {
        max-width: 1000px;
        margin: 2rem auto;
        padding: 2rem;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    }

    .profile-header {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid #eee;
    }

    .profile-header img {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid var(--primary-color);
    }

    .profile-header h2 {
        font-size: 1.8rem;
        margin: 0;
    }

    .profile-header p {
        color: #666;
        margin-top: 0.2rem;
    }

    .profile-section {
        margin-top: 2rem;
    }

    .section-title {
        font-size: 1.4rem;
        font-weight: bold;
        color: #333;
        margin-bottom: 1rem;
    }

    .reservation-card {
        border: 1px solid #eee;
        border-radius: 10px;
        padding: 1rem;
        display: flex;
        gap: 1rem;
        align-items: center;
        margin-bottom: 1rem;
        transition: 0.2s ease;
    }

    .reservation-card:hover {
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }

    .reservation-card img {
        width: 100px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
    }

    .reservation-info h4 {
        margin: 0;
        font-size: 1.1rem;
    }

    .reservation-info p {
        font-size: 0.9rem;
        color: #666;
    }

    .btn-primary {
        background: var(--primary-color);
        color: #fff;
        border: none;
        padding: 0.5rem 1.2rem;
        border-radius: 8px;
        font-size: 0.9rem;
        cursor: pointer;
        transition: background 0.2s ease;
    }

    .btn-primary:hover {
        background: #e03353;
    }
</style>

<div class="profile-container">
    <!-- Profile Header -->
    <div class="profile-header">
        <img src="{{ asset('images/default-avatar.jpg') }}" alt="Guest Profile Picture">
        <div>
            <h2>{{ Auth::user()->name ?? 'Guest Name' }}</h2>
            <p>Joined {{ Auth::user()->created_at->format('F Y') ?? 'Date' }}</p>
            <button class="btn-primary">Edit Profile</button>
        </div>
    </div>

    <!-- My Reservations -->
    <div class="profile-section">
        <h3 class="section-title">My Reservations</h3>

        <!-- Example Reservation -->
        <div class="reservation-card">
            <img src="{{ asset('images/property-sample.jpg') }}" alt="Property">
            <div class="reservation-info">
                <h4>Cozy Apartment in Paris</h4>
                <p>Check-in: 12 Jan 2025 | Check-out: 16 Jan 2025</p>
            </div>
            <button class="btn-primary">View Details</button>
        </div>

        <div class="reservation-card">
            <img src="{{ asset('images/property-sample2.jpg') }}" alt="Property">
            <div class="reservation-info">
                <h4>Beach House in Bali</h4>
                <p>Check-in: 5 Feb 2025 | Check-out: 12 Feb 2025</p>
            </div>
            <button class="btn-primary">View Details</button>
        </div>
    </div>

    <!-- Reviews -->
    <div class="profile-section">
        <h3 class="section-title">My Reviews</h3>
        <p>You haven’t written any reviews yet.</p>
    </div>
</div>
@endsection
