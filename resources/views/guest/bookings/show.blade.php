@extends('layouts.app')

@section('content')
<div class="container py-5">

    {{-- Alerts --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Header --}}
    <div class="mb-4">
        <h2 class="fw-bold mb-1">Booking Details</h2>
        <p class="text-muted mb-0">
            Review the details of your reservation
        </p>
    </div>

    {{-- Main Booking Card --}}
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

        <div class="row g-0">

            {{-- Property Image --}}
            <div class="col-lg-5">
                @if($booking->property && $booking->property->images->isNotEmpty())
                    <img
                        src="{{ \App\Helpers\ImageHelper::url($booking->property->images->first()->image_url) }}"
                        class="w-100 h-100"
                        style="min-height: 420px; object-fit: cover;"
                        alt="{{ $booking->property->title }}"
                    >
                @else
                    <div
                        class="bg-light d-flex align-items-center justify-content-center h-100"
                        style="min-height: 420px;"
                    >
                        <span class="text-muted">No image available</span>
                    </div>
                @endif
            </div>

            {{-- Booking Information --}}
            <div class="col-lg-7">
                <div class="p-4 p-lg-5">

                    {{-- Property Header --}}
                    <div class="mb-4">
                        <h1 class="fw-bold mb-2">
                            {{ $booking->property->title }}
                        </h1>

                        <p class="text-muted mb-2">
                            {{ $booking->property->city ?? '-' }}
                        </p>

                        <p class="mb-0">
                            Hosted by

                            @if($booking->property->host)
                                <a
                                    href="{{ route('host.profile.show', $booking->property->host->id) }}"
                                    class="text-decoration-none fw-semibold"
                                >
                                    {{ $booking->property->host->name }}
                                </a>
                            @else
                                <strong>Unknown</strong>
                            @endif
                        </p>
                    </div>

                    <hr>

                    {{-- Booking Information --}}
                    <div class="row g-4 my-2">

                        <div class="col-sm-6">
                            <small class="text-muted d-block mb-1">
                                Booking ID
                            </small>
                            <strong>#{{ $booking->id }}</strong>
                        </div>

                        <div class="col-sm-6">
                            <small class="text-muted d-block mb-1">
                                Guest
                            </small>
                            <strong>{{ $booking->guest->name ?? 'N/A' }}</strong>
                        </div>

                        <div class="col-sm-6">
                            <small class="text-muted d-block mb-1">
                                Check-in
                            </small>
                            <strong>
                                {{ \Carbon\Carbon::parse($booking->check_in)->format('M d, Y') }}
                            </strong>
                        </div>

                        <div class="col-sm-6">
                            <small class="text-muted d-block mb-1">
                                Check-out
                            </small>
                            <strong>
                                {{ \Carbon\Carbon::parse($booking->check_out)->format('M d, Y') }}
                            </strong>
                        </div>

                        <div class="col-sm-6">
                            <small class="text-muted d-block mb-1">
                                Booking Status
                            </small>

                            @if($booking->status === 'confirmed')
                                <span class="badge bg-success px-3 py-2">
                                    Confirmed
                                </span>
                            @elseif($booking->status === 'pending')
                                <span class="badge bg-warning text-dark px-3 py-2">
                                    Pending
                                </span>
                            @elseif($booking->status === 'cancelled')
                                <span class="badge bg-danger px-3 py-2">
                                    Cancelled
                                </span>
                            @endif
                        </div>

                        <div class="col-sm-6">
                            <small class="text-muted d-block mb-1">
                                Payment Status
                            </small>

                            @if($booking->isPaid())
                                <span class="badge bg-success px-3 py-2">
                                    Paid
                                </span>
                            @elseif($booking->hasPendingPayment())
                                <span class="badge bg-warning text-dark px-3 py-2">
                                    Payment Pending
                                </span>
                            @else
                                <span class="badge bg-secondary px-3 py-2">
                                    Unpaid
                                </span>
                            @endif
                        </div>

                    </div>

                    {{-- Total --}}
                    <div class="bg-light rounded-3 p-3 mt-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted">
                                Total Price
                            </span>

                            <span class="fs-4 fw-bold">
                                ${{ number_format($booking->total_price, 2) }}
                            </span>
                        </div>
                    </div>

                    {{-- Payment Section --}}
                    @switch($booking->status)

                        @case('pending')

                            <div class="alert alert-warning mt-4 mb-0">
                                <h5 class="fw-bold mb-2">
                                    Booking Pending
                                </h5>

                                <p class="mb-0">
                                    Your booking request has been sent to the host.
                                    Please wait for approval before completing payment.
                                </p>
                            </div>

                            @break

                        @case('cancelled')

                            <div class="alert alert-danger mt-4 mb-0">
                                <strong>Booking Cancelled</strong>
                                <p class="mb-0 mt-1">
                                    This booking has been cancelled.
                                </p>
                            </div>

                            @break

                        @case('confirmed')

                            @if(!$booking->isPaid())

                                <div class="alert alert-success mt-4 mb-0">
                                    <h5 class="fw-bold mb-2">
                                        Complete Your Payment
                                    </h5>

                                    <p class="mb-3">
                                        Your booking has been approved.
                                        Complete your payment to finalize your reservation.
                                    </p>

                                    <a
                                        href="{{ route('checkout', $booking) }}"
                                        class="btn btn-success"
                                    >
                                        Pay Now —
                                        ${{ number_format($booking->total_price, 2) }}
                                    </a>

                                    <small class="text-muted d-block mt-2">
                                        You will be redirected to our secure payment page.
                                    </small>
                                </div>

                            @else

                                <div class="alert alert-success mt-4 mb-0">
                                    <strong>Payment Completed</strong>

                                    <p class="mb-0 mt-1">
                                        Your payment was completed successfully.
                                        Your reservation is confirmed.
                                    </p>
                                </div>

                            @endif

                            @break

                    @endswitch

                    {{-- Actions --}}
                    <div class="d-flex flex-column flex-sm-row gap-2 mt-4">

                        <a
                            href="{{ route('guest.bookings.index') }}"
                            class="btn btn-outline-secondary flex-fill"
                        >
                            Back to Bookings
                        </a>

                        @if($booking->status === 'pending' && !$booking->isPaid())

                            <form
                                action="{{ route('guest.bookings.cancel', $booking) }}"
                                method="POST"
                                class="flex-fill"
                            >
                                @csrf
                                @method('PATCH')

                                <button
                                    type="submit"
                                    class="btn btn-danger w-100"
                                >
                                    Cancel Booking
                                </button>
                            </form>

                        @endif

                    </div>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection