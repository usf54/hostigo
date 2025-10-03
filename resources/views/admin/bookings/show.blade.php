@extends('admin.layouts.admin')

@section('content')
<div class="p-4 d-flex justify-content-center">
 @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <!-- Booking Details Card -->
    <div class="card shadow-sm w-100" style="max-width:600px;">
        <div class="card-body">

            <!-- Heading -->
            <h2 class="card-title mb-4" style="font-size:1.5rem; font-weight:700; color:#1E1E2F;">Booking Details</h2>

            <!-- Booking Info -->
            <div class="mb-3">
                <p class="mb-2"><strong>User:</strong> {{ $booking->guest->name ?? 'N/A' }}</p>
                <p class="mb-2"><strong>Property:</strong> {{ $booking->property->title ?? 'N/A' }}</p>
                <p class="mb-2"><strong>Check-In:</strong> {{ $booking->check_in }}</p>
                <p class="mb-2"><strong>Check-Out:</strong> {{ $booking->check_out }}</p>
                <p class="mb-2"><strong>Total Price:</strong> ${{ number_format($booking->total_price, 2) }}</p>
                <p class="mb-2"><strong>Status:</strong>
                    @if($booking->status == 'confirmed')
                        <span class="badge bg-success">Confirmed</span>
                    @elseif($booking->status == 'pending')
                        <span class="badge bg-warning text-dark">Pending</span>
                    @else
                        <span class="badge bg-danger">Cancelled</span>
                    @endif
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('bookings.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Back
                </a>
                <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-success">
                    <i class="fas fa-edit me-1"></i> Edit
                </a>
            </div>

        </div>
    </div>

</div>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
@endsection
