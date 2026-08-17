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

    <h2 class="mb-4">My Bookings</h2>

    <!-- Filters -->
    <div class="filter-bar mb-4">
        <form method="GET" action="{{ route('guest.bookings.index') }}" class="row g-2 align-items-center">
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">Status</option>
                    <option value="confirmed" {{ request('status')=='confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="pending" {{ request('status')=='pending' ? 'selected' : '' }}>Pending</option>
                    <option value="cancelled" {{ request('status')=='cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <div class="col-md-3">
                <select name="city" class="form-select">
                    <option value="">City</option>
                    @foreach($cities as $city)
                        <option value="{{ $city }}" {{ request('city')==$city ? 'selected' : '' }}>{{ $city }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <input type="date" name="date" value="{{ request('date') }}" class="form-control">
            </div>

            <div class="col-md-3 text-end">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
        </form>
    </div>

    <!-- Bookings Grid -->
    <div class="row g-4">
    @forelse($bookings as $booking)
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">

                {{-- Property Image --}}
                @if($booking->property && $booking->property->images->isNotEmpty())
                    <img
                        src="{{ \App\Helpers\ImageHelper::url($booking->property->images->first()->image_url) }}"
                        class="card-img-top"
                        alt="{{ $booking->property->title }}"
                        style="height: 240px; object-fit: cover;"
                    >
                @else
                    <div
                        class="bg-light d-flex align-items-center justify-content-center"
                        style="height: 240px;"
                    >
                        <span class="text-muted">No image available</span>
                    </div>
                @endif

                {{-- Card Body --}}
                <div class="card-body d-flex flex-column p-4">

                    <h5 class="card-title fw-bold mb-3">
                        {{ $booking->property->title ?? 'Property Title' }}
                    </h5>

                    <p class="text-muted mb-3">
                        {{ $booking->property->city ?? '-' }}
                    </p>

                    <div class="mb-3">
                        <p class="mb-2">
                            <strong>Booking ID:</strong>
                            #{{ $booking->id }}
                        </p>

                        <p class="mb-2">
                            <strong>Check-in:</strong>
                            {{ \Carbon\Carbon::parse($booking->check_in)->format('Y-m-d') }}
                        </p>

                        <p class="mb-2">
                            <strong>Check-out:</strong>
                            {{ \Carbon\Carbon::parse($booking->check_out)->format('Y-m-d') }}
                        </p>

                        <p class="mb-0">
                            <strong>Total:</strong>
                            <span class="fw-bold">
                                ${{ number_format($booking->total_price, 2) }}
                            </span>
                        </p>
                    </div>

                    {{-- Status --}}
                    <div class="mb-3">
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

                    {{-- Button --}}
                    <div class="mt-auto pt-2">
                        <a
                            href="{{ route('guest.bookings.show', $booking->id) }}"
                            class="btn btn-primary w-100"
                        >
                            View Booking
                        </a>
                    </div>

                </div>
            </div>
        </div>

    @empty
        <div class="col-12 text-center py-5 text-muted">
            No bookings found.
        </div>
    @endforelse
</div>
</div>
@endsection
