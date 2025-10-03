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
    <!-- Edit Booking Card -->
    <div class="card shadow-sm w-100" style="max-width:600px;">
        <div class="card-body">

            <!-- Heading -->
            <h2 class="card-title mb-4" style="font-size:1.5rem; font-weight:700; color:#1E1E2F;">Edit Booking</h2>

            <!-- Edit Booking Form -->
            <form action="{{ route('bookings.update', $booking->id) }}" method="POST" class="row g-3">
                @csrf
                @method('PUT')

                <!-- User (Read-only) -->
                <div class="col-12">
                    <label class="form-label fw-semibold" for="user">User</label>
                    <input id="user" type="text" class="form-control" value="{{ $booking->guest->name ?? 'N/A' }}" disabled>
                </div>

                <!-- Property (Read-only) -->
                <div class="col-12">
                    <label class="form-label fw-semibold" for="property">Property</label>
                    <input id="property" type="text" class="form-control" value="{{ $booking->property->title ?? 'N/A' }}" disabled>
                </div>

                <!-- Check-in Date -->
                <div class="col-12">
                    <label class="form-label fw-semibold" for="check-in">Check-In</label>
                    <input id="check-in" type="date" name="check_in" class="form-control" value="{{ $booking->check_in }}">
                </div>

                <!-- Check-out Date -->
                <div class="col-12">
                    <label class="form-label fw-semibold" for="check-out">Check-Out</label>
                    <input id="check-out" type="date" name="check_out" class="form-control" value="{{ $booking->check_out }}">
                </div>

                <!-- Status -->
                <div class="col-12">
                    <label class="form-label fw-semibold" for="status">Status</label>
                    <select name="status" class="form-select" id="status">
                        <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <!-- Save Button -->
                <div class="col-12">
                    <button type="submit" class="btn btn-success w-100">
                        <i class="fas fa-save me-1"></i> Save
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
@endsection
