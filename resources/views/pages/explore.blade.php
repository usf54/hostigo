@extends('layouts.app')

@section('content')

<!-- Filters -->
<div class="filter-bar">
  <div class="container">
    <form method="GET" action="{{ route('public.properties') }}" class="row g-2 align-items-center">
      <div class="col-md-3">
        <input type="text" name="location" value="{{ request('location') }}" class="form-control" placeholder="Location">
      </div>
      <div class="col-md-3">
        <select name="max_guests" class="form-select">
          <option value="">Max Guests</option>
          <option value="1" {{ request('max_guests')=='1' ? 'selected' : '' }}>1 Guest</option>
          <option value="2" {{ request('max_guests')=='2' ? 'selected' : '' }}>2 Guests</option>
          <option value="4" {{ request('max_guests')=='4' ? 'selected' : '' }}>4 Guests</option>
          <option value="6" {{ request('max_guests')=='6' ? 'selected' : '' }}>6 Guests</option>
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
