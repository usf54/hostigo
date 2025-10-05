@extends('layouts.app')

@section('content')
<div class="container py-5">
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
    <!-- Header -->
    <div class="mb-4">
        <h2 class="fw-bold">Booking Details</h2>
        <p class="text-muted">Review all the details of your booking</p>
    </div>

    <div class="card shadow-sm rounded-4">
        <!-- Property Image -->
        @if($booking->property && $booking->property->images->isNotEmpty())
            <img src="{{ asset('storage/'.$booking->property->images->first()->image_url) }} "
                 class="card-img-top rounded-top-4"
                 alt="{{ $booking->property->title }}"
                 style="height: 300px; object-fit: cover;">
        @endif

        <div class="card-body">
            <div class="mb-4">
                <h1 class="fw-bold">{{ $booking->property->title }}</h1>
                <p class="text-muted">
                    Hosted by
                    @if($booking->property->host)
                        <a href="{{ route('host.profile.show', $booking->property->host->id) }}" class="text-decoration-none">
                            <strong>{{ $booking->property->host->name }}</strong>
                        </a>
                    @else
                        <strong>Unknown</strong>
                    @endif
                </p>
            </div>
            <div class="row mb-3 text-muted">
                <div class="col-md-6 mb-2">
                    <p class="mb-1"><strong>City</strong></p>
                    <p>{{ $booking->property->city ?? '-' }}</p>
                </div>
                <div class="col-md-6 mb-2">
                    <p class="mb-1"><strong>Guest Name</strong></p>
                    <p>{{ $booking->guest->name ?? 'N/A' }}</p>
                </div>
                <div class="col-md-6 mb-2">
                    <p class="mb-1"><strong>Check-in</strong></p>
                    <p>{{ \Carbon\Carbon::parse($booking->check_in)->format('M d, Y') }}</p>
                </div>
                <div class="col-md-6 mb-2">
                    <p class="mb-1"><strong>Check-out</strong></p>
                    <p>{{ \Carbon\Carbon::parse($booking->check_out)->format('M d, Y') }}</p>
                </div>
                <div class="col-md-6 mb-2">
                    <p class="mb-1"><strong>Status</strong></p>
                    @if($booking->status === 'confirmed')
                        <span class="badge bg-success">Confirmed</span>
                    @elseif($booking->status === 'pending')
                        <span class="badge bg-warning text-dark">Pending</span>
                    @elseif($booking->status === 'cancelled')
                        <span class="badge bg-danger">Cancelled</span>
                    @endif
                </div>
                <div class="col-md-6 mb-2">
                    <p class="mb-1"><strong>Total Price</strong></p>
                    <p class="fw-bold">${{ number_format($booking->total_price, 2) }}</p>
                </div>
                
                <!-- Payment Status -->
                <div class="col-md-6 mb-2">
                    <p class="mb-1"><strong>Payment Status</strong></p>
                    @if($booking->isPaid())
                        <span class="badge bg-success">Paid</span>
                    @elseif($booking->hasPendingPayment())
                        <span class="badge bg-warning text-dark">Payment Pending</span>
                    @else
                        <span class="badge bg-secondary">Unpaid</span>
                    @endif
                </div>
            </div>

            <!-- Payment Section -->
            @if($booking->status === 'pending' && !$booking->isPaid())
                <div class="mt-4 p-4 border rounded bg-light">
                    <h4 class="mb-3">Complete Payment</h4>
                    <p class="mb-3">Your booking is pending payment. Click the button below to complete your payment and confirm your booking.</p>
                    <a href="{{ route('checkout', $booking) }}" class="btn btn-success">
                        <i class="fas fa-credit-card"></i> Pay Now - ${{ number_format($booking->total_price, 2) }}
                    </a>
                    <p class="text-muted mt-2 mb-0">
                        <small>You will be redirected to our secure payment page.</small>
                    </p>
                </div>
            @elseif($booking->isPaid())
                <div class="alert alert-success mt-4">
                    <i class="fas fa-check-circle"></i> 
                    Payment Completed Successfully - Your booking is confirmed!
                </div>
            @endif

            <!-- Action Buttons -->
            <div class="d-flex flex-column flex-md-row gap-2 mt-4">
                <a href="{{ route('guest.bookings.index') }}"
                class="btn btn-primary flex-fill">Back to Bookings</a>

                @if($booking->status === 'pending' && !$booking->isPaid())
                    <form action="{{ route('guest.bookings.cancel', $booking) }}" method="POST" class="flex-fill">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-danger w-100">Cancel Booking</button>
                    </form>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection