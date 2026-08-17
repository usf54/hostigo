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
    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">

        @php
            $image = $property->images->first();
        @endphp

        {{-- Property Image --}}
        <div class="ratio ratio-4x3">
            @if($image)
                <img
                    src="{{ \App\Helpers\ImageHelper::url($image->image_url) }}"
                    alt="{{ $property->title }}"
                    class="w-100 h-100"
                    style="object-fit: cover;"
                >
            @else
                <div class="bg-light d-flex align-items-center justify-content-center">
                    <span class="text-muted">No image available</span>
                </div>
            @endif
        </div>

        {{-- Property Info --}}
        <div class="card-body d-flex flex-column p-4">

            <h5 class="fw-bold mb-2">
                {{ $property->title }}
            </h5>

            <p class="text-muted mb-3">
                <i class="bi bi-geo-alt me-1"></i>
                {{ $property->city ?? 'Unknown location' }}
                @if($property->country)
                    , {{ $property->country }}
                @endif
            </p>

            <div class="mb-3">
                <span class="fs-5 fw-bold" style="color: #FF385C;">
                    ${{ number_format($property->price_per_night, 2) }}
                </span>
                <span class="text-muted">
                    / night
                </span>
            </div>

            <div class="d-flex align-items-center text-muted mb-4">
                <i class="bi bi-people me-2"></i>
                <span>
                    Up to {{ $property->max_guests ?? '-' }} guests
                </span>
            </div>

            <a
                href="{{ route('public.property.details', $property->id) }}"
                class="btn w-100 mt-auto text-white"
                style="background-color: #FF385C;"
            >
                View Property
            </a>

        </div>
    </div>
</div>
        @empty
            <p class="text-muted">This host has no properties yet.</p>
        @endforelse
    </div>
</div>
@endsection
