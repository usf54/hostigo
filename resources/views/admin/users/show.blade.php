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
    <div class="card shadow-sm w-100" style="max-width:600px;">
        <div class="card-body">

            <!-- Heading -->
            <h2 class="card-title mb-4" style="font-size:1.5rem; font-weight:700; color:#1E1E2F;">User Details</h2>

            <!-- User Info -->
            <div class="mb-3">
                @if($user->image)
                    <div class="text-center mb-3">
                        <img src="{{ asset('storage/' . $user->image) }}" alt="{{ $user->name }}" class="rounded-circle" style="width:100px; height:100px; object-fit:cover;">
                    </div>
                @endif
                <p class="mb-2"><strong>Name:</strong> {{ $user->name }}</p>
                <p class="mb-2"><strong>Email:</strong> {{ $user->email }}</p>
                <p class="mb-2"><strong>Phone:</strong> {{ $user->phone ?? 'N/A' }}</p>
                <p class="mb-2"><strong>Role:</strong>
                    <span class="badge
                        @if($user->role == 'admin') bg-danger
                        @elseif($user->role == 'host') bg-warning
                        @else bg-primary
                        @endif">
                        {{ ucfirst($user->role) }}
                    </span>
                </p>
                <p class="mb-2"><strong>Created At:</strong> {{ $user->created_at->format('d M Y, H:i') }}</p>
                <p class="mb-2"><strong>Updated At:</strong> {{ $user->updated_at->format('d M Y, H:i') }}</p>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('users.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Back
                </a>
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-success">
                    <i class="fas fa-edit me-1"></i> Edit
                </a>
            </div>

        </div>
    </div>

</div>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
@endsection
