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
    <!-- Property Details Card -->
    <div class="card shadow-sm w-100" style="max-width:800px;">
        <div class="card-body">

            <!-- Heading -->
            <h2 class="card-title mb-4" style="font-size:1.5rem; font-weight:700; color:#1E1E2F;">Property Details</h2>

            <!-- Property Info -->
            <div class="mb-3">
                <p class="mb-2"><strong>Title:</strong> {{ $property->title }}</p>
                <p class="mb-2"><strong>Location:</strong> {{ $property->city }}, {{ $property->country }}</p>
                <p class="mb-2"><strong>Price:</strong> ${{ number_format($property->price_per_night, 2) }}</p>
                <p class="mb-2"><strong>Status:</strong>
                    @if($property->is_active)
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-secondary">Inactive</span>
                    @endif
                </p>
                @if($property->description)
                    <p class="mb-2"><strong>Description:</strong> {{ $property->description }}</p>
                @endif
                @if($property->max_guests)
                    <p class="mb-2"><strong>Max Guests:</strong> {{ $property->max_guests }}</p>
                @endif
                @if($property->address)
                    <p class="mb-2"><strong>Address:</strong> {{ $property->address }}</p>
                @endif
            </div>

            <!-- Images -->
            @if($property->images->count())
            <div class="mb-3">
                <h5 class="fw-semibold">Images</h5>
                <div class="d-flex flex-wrap gap-2">
                    @foreach($property->images as $image)
                        <img src="{{ asset('storage/' . $image->image_url) }}" alt="Image of {{ $property->title }}" class="rounded shadow-sm" style="width:120px; height:90px; object-fit:cover;">
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Amenities -->
            @if($property->amenities->count())
            <div class="mb-3">
                <h5 class="fw-semibold">Amenities</h5>
                <ul class="list-inline">
                    @foreach($property->amenities as $amenity)
                        <li class="list-inline-item badge bg-primary me-1 mb-1">{{ $amenity->name }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Host Info -->
            @if($property->host)
            <div class="mb-3">
                <h5 class="fw-semibold">Host</h5>
                <p>{{ $property->host->name }} ({{ $property->host->email }})</p>
            </div>
            @endif

            <!-- Action Buttons -->
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('properties.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Back
                </a>
                <a href="{{ route('properties.edit', $property->id) }}" class="btn btn-success">
                    <i class="fas fa-edit me-1"></i> Edit
                </a>
            </div>

        </div>
    </div>

</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
@endsection
