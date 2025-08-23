@extends('layouts.app')

@section('content')
<div class="container py-5">

    <!-- Property Title & Host -->
<div class="mb-4">
    <h1 class="fw-bold">{{ $property->title }}</h1>
    <p class="text-muted">Hosted by <strong>{{ $property->host->name ?? 'Unknown' }}</strong></p>
</div>

<!-- Image Gallery -->
<div class="row g-3 mb-4">
    <div class="col-md-6">
        <img src="{{ asset('storage/'.$property->images->first()->image_url ?? 'placeholder.jpg') }}" class="img-fluid rounded" alt="{{ $property->title }}">
    </div>
    <div class="col-md-6">
        <div class="row g-3">
            @foreach($property->images->skip(1)->take(4) as $image)
                <div class="col-6">
                    <img src="{{ asset('storage/'.$image->image_url) }}" class="img-fluid rounded" alt="{{ $property->title }}">
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Property Info -->
<div class="row">
    <div class="col-lg-8">
        <div class="mb-4">
            <h4>About this property</h4>
            <p>{{ $property->description }}</p>
        </div>

        <div class="mb-4">
            <h4>Features</h4>
            <ul class="list-unstyled">
                @foreach($property->amenities as $amenity)
                    <li>✔ {{ $amenity->name }}</li>
                @endforeach
            </ul>
        </div>

        <div>
            <h4>Location</h4>
            <div class="ratio ratio-16x9">
                <iframe src="https://www.google.com/maps?q={{ $property->latitude }},{{ $property->longitude }}&hl=es;z=14&output=embed"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow-sm p-3">
            <h4 class="fw-bold mb-2">${{ $property->price_per_night }} / night</h4>
            <div class="mb-3">
                <label class="form-label">Check-in</label>
                <input type="date" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Check-out</label>
                <input type="date" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Guests</label>
                <input type="number" class="form-control" min="1" value="1">
            </div>
            <button class="btn w-100" style="background-color: #FF385C; color: white;">
                Reserve
            </button>
        </div>
    </div>
</div>


</div>
@endsection
