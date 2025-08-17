@extends('admin.layouts.admin')

@section('content')
<div class="p-4 d-flex justify-content-center">

    <!-- Edit Property Card -->
    <div class="card shadow-sm w-100" style="max-width:600px;">
        <div class="card-body">

            <!-- Heading -->
            <h2 class="card-title mb-4" style="font-size:1.5rem; font-weight:700; color:#1E1E2F;">Edit Property</h2>

            <!-- Edit Form -->
            <form class="row g-3">

                <!-- Title -->
                <div class="col-12">
                    <label class="form-label fw-semibold">Title</label>
                    <input type="text" class="form-control" value="Luxury Villa">
                </div>

                <!-- Location -->
                <div class="col-12">
                    <label class="form-label fw-semibold">Location</label>
                    <input type="text" class="form-control" value="Paris">
                </div>

                <!-- Price -->
                <div class="col-12">
                    <label class="form-label fw-semibold">Price</label>
                    <input type="text" class="form-control" value="$500">
                </div>

                <!-- Status -->
                <div class="col-12">
                    <label class="form-label fw-semibold">Status</label>
                    <select class="form-select">
                        <option>Active</option>
                        <option>Inactive</option>
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
