@extends('layouts.app')

@section('title', 'Add New Property')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-8">

      <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white border-0 pb-0">
          <h2 class="fw-bold mb-0" style="color: #FF385C;">Add New Property</h2>
          <p class="text-muted mt-1 mb-4">Create your listing to start welcoming guests</p>
        </div>

        <div class="card-body p-4">
          <form action="{{ route('property.store') }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf

            {{-- Title --}}
            <div class="form-floating mb-4">
              <input type="text" name="title" id="title"
                class="form-control @error('title') is-invalid @enderror"
                value="{{ old('title') }}" placeholder="Cozy Beachside Villa" required>
              <label for="title">Property Title</label>
              @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Description --}}
            <div class="form-floating mb-4">
              <textarea name="description" id="description" rows="5"
                class="form-control @error('description') is-invalid @enderror"
                placeholder="Describe your property">{{ old('description') }}</textarea>
              <label for="description">Description</label>
              @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Price --}}
            <div class="form-floating mb-4">
              <input type="number" step="0.01" name="price_per_night" id="price_per_night"
                class="form-control @error('price_per_night') is-invalid @enderror"
                value="{{ old('price_per_night') }}" required>
              <label for="price_per_night">Price per Night (USD)</label>
              @error('price_per_night') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Address, City, Country --}}
            <div class="form-floating mb-4">
              <input type="text" name="address" id="address" class="form-control"
                value="{{ old('address') }}" placeholder="123 Ocean Drive">
              <label for="address">Address</label>
            </div>

            <div class="row g-3 mb-4">
              <div class="col-md-6">
                <div class="form-floating">
                  <input type="text" name="city" id="city" class="form-control"
                    value="{{ old('city') }}" placeholder="Miami">
                  <label for="city">City</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-floating">
                  <input type="text" name="country" id="country" class="form-control"
                    value="{{ old('country') }}" placeholder="United States">
                  <label for="country">Country</label>
                </div>
              </div>
            </div>

            {{-- Coordinates --}}
            <div class="row g-3 mb-4">
              <div class="col-md-6">
                <div class="form-floating">
                  <input type="number" step="0.00000001" name="latitude"
                    value="{{ old('latitude') }}" class="form-control" placeholder="25.7617">
                  <label for="latitude">Latitude</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-floating">
                  <input type="number" step="0.00000001" name="longitude"
                    value="{{ old('longitude') }}" class="form-control" placeholder="-80.1918">
                  <label for="longitude">Longitude</label>
                </div>
              </div>
            </div>

            {{-- Max Guests --}}
            <div class="form-floating mb-4">
              <input type="number" name="max_guests" id="max_guests"
                value="{{ old('max_guests', 1) }}" min="1"
                class="form-control" placeholder="1">
              <label for="max_guests">Max Guests</label>
            </div>

            {{-- Amenities --}}
            <div class="mb-4">
              <label class="form-label">Amenities</label>
              <div class="row">
                @foreach($amenities as $amenity)
                  <div class="col-md-4">
                    <div class="form-check">
                      <input id="amenity" class="form-check-input" type="checkbox"
                        name="amenities[]" value="{{ $amenity->id }}"
                        {{ in_array($amenity->id, old('amenities', [])) ? 'checked' : '' }}>
                      <label for="amenity" class="form-check-label">{{ $amenity->name }}</label>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>

            {{-- Images --}}
            <div class="mb-4">
              <label class="form-label" for="property">Property Images</label>
              <input id="property" type="file" name="images[]" class="form-control" multiple>
            </div>

            <div class="d-grid mt-4">
              <button type="submit" class="btn btn-lg btn-primary" style="background:#FF385C;border:none;">
                Add Property
              </button>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection
