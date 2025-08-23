@extends('layouts.app')

@section('content')

<!-- Filters -->
<div class="filter-bar">
  <div class="container">
    <form class="row g-2 align-items-center">
      <div class="col-md-3">
        <input type="text" name="location" value="{{ request('location') }}" class="form-control" placeholder="Location">
      </div>
      <div class="col-md-3">
        <select name="property_type" class="form-select">
          <option value="">Property Type</option>
          <option value="Apartment" {{ request('property_type')=='Apartment' ? 'selected' : '' }}>Apartment</option>
          <option value="House" {{ request('property_type')=='House' ? 'selected' : '' }}>House</option>
          <option value="Villa" {{ request('property_type')=='Villa' ? 'selected' : '' }}>Villa</option>
          <option value="Studio" {{ request('property_type')=='Studio' ? 'selected' : '' }}>Studio</option>
        </select>
      </div>
      <div class="col-md-3">
        <select name="price_range" class="form-select">
          <option value="">Price Range</option>
          <option value="$80 - $150" {{ request('price_range')=='$80 - $150' ? 'selected' : '' }}>$80 - $150</option>
          <option value="$150 - $250" {{ request('price_range')=='$150 - $250' ? 'selected' : '' }}>$150 - $250</option>
          <option value="$250+" {{ request('price_range')=='$250+' ? 'selected' : '' }}>$250+</option>
        </select>
      </div>
      <div class="col-md-3 text-end">
        <button type="submit" class="btn btn-ff w-100">Search</button>
      </div>
    </form>
  </div>
</div>

<!-- Properties Grid -->
<div class="container my-4">
  <div class="row g-3">
    @forelse($properties as $property)
      <div class="col-md-4">
        <a href="{{ route('public.property.details', $property->id) }}" class="text-decoration-none text-dark d-block h-100">
          <div class="card property-card border-0 shadow-sm">
            <img src="{{ asset('storage/'.$property->images->first()->image_url ?? 'placeholder.jpg') }}" class="card-img-top" alt="{{ $property->title }}">
            <div class="card-body">
              <h5 class="card-title">{{ $property->title }}</h5>
              <p class="card-text text-muted mb-1">{{ $property->city }}, {{ $property->country }}</p>
              <p class="fw-bold">${{ $property->price_per_night }}/night</p>
              <div class="text-warning">
                @for($i=0; $i<5; $i++)
                  {!! $i < round($property->rating ?? 4) ? '&#9733;' : '&#9734;' !!}
                @endfor
                <span class="text-muted small">({{ $property->reviews_count ?? 0 }} reviews)</span>
              </div>
            </div>
          </div>
        </a>
      </div>
    @empty
      <div class="col-12 text-center py-5 text-muted">
        No properties found.
      </div>
    @endforelse
  </div>
</div>

@endsection
