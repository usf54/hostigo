@extends('admin.layouts.admin')

@section('content')
<div class="p-4 d-flex justify-content-center">

    <!-- Edit Booking Card -->
    <div class="card shadow-sm w-100" style="max-width:600px;">
        <div class="card-body">

            <!-- Heading -->
            <h2 class="card-title mb-4" style="font-size:1.5rem; font-weight:700; color:#1E1E2F;">Edit Booking</h2>

            <!-- Edit Booking Form -->
            <form class="row g-3">

                <!-- User -->
                <div class="col-12">
                    <label class="form-label fw-semibold">User</label>
                    <input type="text" class="form-control" value="John Doe">
                </div>

                <!-- Property -->
                <div class="col-12">
                    <label class="form-label fw-semibold">Property</label>
                    <input type="text" class="form-control" value="Luxury Villa">
                </div>

                <!-- Date -->
                <div class="col-12">
                    <label class="form-label fw-semibold">Date</label>
                    <input type="date" class="form-control" value="2025-08-17">
                </div>

                <!-- Status -->
                <div class="col-12">
                    <label class="form-label fw-semibold">Status</label>
                    <select class="form-select">
                        <option>Confirmed</option>
                        <option>Pending</option>
                        <option>Cancelled</option>
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
