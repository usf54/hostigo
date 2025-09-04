@extends('admin.layouts.admin')

@section('content')
<div class="p-4 d-flex justify-content-center">

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
                    <label class="form-label fw-semibold">User</label>
                    <input type="text" class="form-control" value="{{ $booking->guest->name ?? 'N/A' }}" disabled>
                </div>

                <!-- Property (Read-only) -->
                <div class="col-12">
                    <label class="form-label fw-semibold">Property</label>
                    <input type="text" class="form-control" value="{{ $booking->property->title ?? 'N/A' }}" disabled>
                </div>

                <!-- Check-in Date -->
                <div class="col-12">
                    <label class="form-label fw-semibold">Check-In</label>
                    <input type="date" name="check_in" class="form-control" value="{{ $booking->check_in }}">
                </div>

                <!-- Check-out Date -->
                <div class="col-12">
                    <label class="form-label fw-semibold">Check-Out</label>
                    <input type="date" name="check_out" class="form-control" value="{{ $booking->check_out }}">
                </div>

                <!-- Status -->
                <div class="col-12">
                    <label class="form-label fw-semibold">Status</label>
                    <select name="status" class="form-select">
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
