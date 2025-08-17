@extends('admin.layouts.admin')

@section('content')
<div class="p-4 d-flex justify-content-center">

    <!-- Property Details Card -->
    <div class="card shadow-sm w-100" style="max-width:600px;">
        <div class="card-body">

            <!-- Heading -->
            <h2 class="card-title mb-4" style="font-size:1.5rem; font-weight:700; color:#1E1E2F;">Property Details</h2>

            <!-- Property Info -->
            <div class="mb-3">
                <p class="mb-2"><strong>Title:</strong> Luxury Villa</p>
                <p class="mb-2"><strong>Location:</strong> Paris</p>
                <p class="mb-2"><strong>Price:</strong> $500</p>
                <p class="mb-2"><strong>Status:</strong> 
                    <span class="badge bg-success">Active</span>
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('properties.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Back
                </a>
                <a href="{{ route('properties.edit', 1) }}" class="btn btn-success">
                    <i class="fas fa-edit me-1"></i> Edit
                </a>
            </div>

        </div>
    </div>

</div>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
@endsection
