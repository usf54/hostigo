@extends('admin.layouts.admin')

@section('content')
<div class="p-4 d-flex justify-content-center">

    <div class="card shadow-sm w-100" style="max-width:600px;">
        <div class="card-body">

            <!-- Heading -->
            <h2 class="card-title mb-4" style="font-size:1.5rem; font-weight:700; color:#1E1E2F;">User Details</h2>

            <!-- User Info -->
            <div class="mb-3">
                <p class="mb-2"><strong>Name:</strong> John Doe</p>
                <p class="mb-2"><strong>Email:</strong> john@example.com</p>
                <p class="mb-2"><strong>Role:</strong> <span class="badge bg-primary">User</span></p>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('users.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Back
                </a>
                <a href="{{ route('users.edit', 1) }}" class="btn btn-success">
                    <i class="fas fa-edit me-1"></i> Edit
                </a>
            </div>

        </div>
    </div>

</div>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
@endsection
