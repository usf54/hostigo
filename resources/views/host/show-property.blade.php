@extends('layouts.app')

@section('title', $property->title . ' - Details')

@section('content')
<div class="container py-5">
  <div class="row g-4">

    {{-- Property Images --}}
    <div class="col-lg-7">
      <div id="propertyCarousel" class="carousel slide card border-0 shadow-sm rounded-4 overflow-hidden mb-4"
          data-bs-ride="carousel"
          data-bs-interval="3000"> {{-- 3000ms = 3 seconds --}}
        
        {{-- Carousel indicators --}}
        <div class="carousel-indicators">
          @foreach($property->images as $index => $image)
            <button type="button" data-bs-target="#propertyCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}" aria-current="{{ $index === 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}"></button>
          @endforeach
        </div>

        {{-- Carousel inner --}}
        <div class="carousel-inner">
          @foreach($property->images as $index => $image)
            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
              <img src="{{ asset('storage/'.$image->image_url) }}" class="d-block w-100" alt="{{ $property->title }}">
            </div>
          @endforeach
        </div>

        {{-- Carousel controls --}}
        <button class="carousel-control-prev" type="button" data-bs-target="#propertyCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#propertyCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>

      </div>
    </div>



    {{-- Property Details --}}
    <div class="col-lg-5">
      <div class="card border-0 shadow-sm rounded-4 p-4">
        <h2 class="fw-bold" style="color: #FF385C;">{{ ucfirst($property->title) }}</h2>
        <p class="text-muted mb-2">{{ $property->city }}, {{ $property->country }}</p>
        <p class="mb-4">{{ $property->description }}</p>

        <div class="mb-3">
          <strong>Price per Night:</strong>
          <span class="ms-2" style="color: #FF385C;">${{ $property->price_per_night }}</span>
        </div>

        <div class="mb-3">
          <strong>Max Guests:</strong>
          <span class="ms-2">{{ $property->max_guests }}</span>
        </div>

        <div class="mb-3">
          <strong>Amenities:</strong>
          @foreach($property->amenities as $amenity)
            <span class="ms-2">{{ $amenity->name }} |</span>
          @endforeach
        </div>
        
        <div class="mb-3">
          <strong>Address:</strong>
          <span class="ms-2">{{ $property->address }}</span>
        </div>
        

        <div class="mb-3">
          <strong>Coordinates:</strong>
          <span class="ms-2">Lat: {{ $property->latitude }}, Lng: {{ $property->longitude }}</span>
        </div>

        <hr>

        <div class="d-flex gap-3 mt-4">
          <a href="{{ route('property.edit', $property->id) }}" 
             class="btn btn-outline-warning px-4" >
            Edit Property
          </a>
          <form action="{{ route('property.destroy', $property->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger px-4">
              Remove Property
            </button>
          </form>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection
