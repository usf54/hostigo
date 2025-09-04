@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Host Info -->
    <div class="d-flex align-items-center mb-5">
        <div class="me-4">
            @if($host->image)
                <img src="{{ asset('storage/' . $host->image) }}" alt="{{ $host->name }}" class="rounded-circle" style="width:120px; height:120px; object-fit:cover;">
            @else
                <div class="rounded-circle bg-secondary text-white d-flex justify-content-center align-items-center" style="width:120px; height:120px;">
                    <span class="fs-3">{{ strtoupper(substr($host->name, 0, 1)) }}</span>
                </div>
            @endif
        </div>
        <div>
            <h2 class="fw-bold">{{ $host->name }}</h2>
            <p class="text-muted mb-1">Email: {{ $host->email }}</p>
            <p class="text-muted mb-1">Phone: {{ $host->phone }}</p>
        </div>
    </div>

    <!-- Host Properties -->
    <h3 class="fw-semibold mb-4">Properties by {{ $host->name }}</h3>
    <div class="row g-4">
        @forelse($host->properties as $property)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('storage/'.$property->images->first()->image_url ?? 'placeholder.jpg') }}" class="card-img-top" alt="{{ $property->title }}">
                    
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $property->title }}</h5>
                        <p class="text-muted mb-1">{{ $property->city ?? 'Unknown location' }}</p>
                        <p class="mb-1"><strong>Price:</strong> ${{ number_format($property->price_per_night, 2) }} per night</p>
                        <p class="mb-2"><strong>Guests:</strong> {{ $property->max_guests ?? '-' }}</p>
                        <a href="{{ route('public.property.details', $property->id) }}" class="btn btn-primary mt-auto">View Property</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">This host has no properties yet.</p>
        @endforelse
    </div>
</div>
@endsection
