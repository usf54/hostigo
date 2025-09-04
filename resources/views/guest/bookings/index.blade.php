@extends('layouts.app')

@section('content')
<div class="container py-5">
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
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm">
                    @if($booking->property && $booking->property->images->isNotEmpty())
                        <img src="{{ asset('storage/'.$booking->property->images->first()->image_url) }}" class="card-img-top" alt="{{ $booking->property->title }}">
                    @else
                        <img src="https://via.placeholder.com/400x250" class="card-img-top" alt="No Image">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $booking->property->title ?? 'Property Title' }}</h5>
                        <p class="mb-1"><strong>City:</strong> {{ $booking->property->city ?? '-' }}</p>
                        <p class="mb-1"><strong>Check-in:</strong> {{ \Carbon\Carbon::parse($booking->check_in)->format('Y-m-d') }}</p>
                        <p class="mb-2"><strong>Booking ID:</strong> {{ $booking->id }}</p>

                        @if($booking->status === 'confirmed')
                            <span class="badge bg-success mb-3">Confirmed</span>
                        @elseif($booking->status === 'pending')
                            <span class="badge bg-warning text-dark mb-3">Pending</span>
                        @elseif($booking->status === 'cancelled')
                            <span class="badge bg-danger mb-3">Cancelled</span>
                        @endif

                        <a href="{{ route('guest.bookings.show', $booking->id) }}" class="btn btn-primary float-end">View</a>
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
