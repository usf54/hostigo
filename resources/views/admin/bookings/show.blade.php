@extends('admin.layouts.admin')

@section('content')
<div class="p-4 d-flex justify-content-center">

    <!-- Booking Details Card -->
    <div class="card shadow-sm w-100" style="max-width:600px;">
        <div class="card-body">

            <!-- Heading -->
            <h2 class="card-title mb-4" style="font-size:1.5rem; font-weight:700; color:#1E1E2F;">Booking Details</h2>

            <!-- Booking Info -->
            <div class="mb-3">
                <p class="mb-2"><strong>User:</strong> John Doe</p>
                <p class="mb-2"><strong>Property:</strong> Luxury Villa</p>
                <p class="mb-2"><strong>Date:</strong> 2025-08-17</p>
                <p class="mb-2"><strong>Status:</strong> 
                    <span class="badge bg-success">Confirmed</span>
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('bookings.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Back
                </a>
                <a href="{{ route('bookings.edit', 1) }}" class="btn btn-success">
                    <i class="fas fa-edit me-1"></i> Edit
                </a>
            </div>

        </div>
    </div>

</div>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
@endsection
