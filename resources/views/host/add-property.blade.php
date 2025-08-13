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
          <form action="" method="POST" novalidate>
            @csrf

            {{-- Title --}}
            <div class="form-floating mb-4">
              <input
                type="text"
                name="title"
                id="title"
                class="form-control @error('title') is-invalid @enderror"
                placeholder="Cozy Beachside Villa"
                value="{{ old('title') }}"
                required
              >
              <label for="title">Property Title</label>
              @error('title')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            {{-- Description --}}
            <div class="form-floating mb-4">
              <textarea
                name="description"
                id="description"
                rows="5"
                class="form-control @error('description') is-invalid @enderror"
                placeholder="Describe your property and its unique features"
              >{{ old('description') }}</textarea>
              <label for="description">Description</label>
              @error('description')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            {{-- Price per Night --}}
            <div class="form-floating mb-4">
              <input
                type="number"
                name="price_per_night"
                id="price_per_night"
                step="0.01"
                min="0"
                class="form-control @error('price_per_night') is-invalid @enderror"
                placeholder="150.00"
                value="{{ old('price_per_night') }}"
                required
              >
              <label for="price_per_night">Price per Night (USD)</label>
              @error('price_per_night')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            {{-- Address --}}
            <div class="form-floating mb-4">
              <input
                type="text"
                name="address"
                id="address"
                class="form-control @error('address') is-invalid @enderror"
                placeholder="123 Ocean Drive"
                value="{{ old('address') }}"
              >
              <label for="address">Address</label>
              @error('address')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="row g-3 mb-4">
              {{-- City --}}
              <div class="col-md-6">
                <div class="form-floating">
                  <input
                    type="text"
                    name="city"
                    id="city"
                    class="form-control @error('city') is-invalid @enderror"
                    placeholder="Miami"
                    value="{{ old('city') }}"
                  >
                  <label for="city">City</label>
                  @error('city')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              {{-- Country --}}
              <div class="col-md-6">
                <div class="form-floating">
                  <input
                    type="text"
                    name="country"
                    id="country"
                    class="form-control @error('country') is-invalid @enderror"
                    placeholder="United States"
                    value="{{ old('country') }}"
                  >
                  <label for="country">Country</label>
                  @error('country')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>

            <div class="row g-3 mb-4">
              {{-- Latitude --}}
              <div class="col-md-6">
                <div class="form-floating">
                  <input
                    type="number"
                    step="0.00000001"
                    name="latitude"
                    id="latitude"
                    class="form-control @error('latitude') is-invalid @enderror"
                    placeholder="25.7617"
                    value="{{ old('latitude') }}"
                  >
                  <label for="latitude">Latitude</label>
                  @error('latitude')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              {{-- Longitude --}}
              <div class="col-md-6">
                <div class="form-floating">
                  <input
                    type="number"
                    step="0.00000001"
                    name="longitude"
                    id="longitude"
                    class="form-control @error('longitude') is-invalid @enderror"
                    placeholder="-80.1918"
                    value="{{ old('longitude') }}"
                  >
                  <label for="longitude">Longitude</label>
                  @error('longitude')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>

            {{-- Max Guests --}}
            <div class="form-floating mb-4">
              <input
                type="number"
                name="max_guests"
                id="max_guests"
                class="form-control @error('max_guests') is-invalid @enderror"
                placeholder="1"
                min="1"
                value="{{ old('max_guests', 1) }}"
              >
              <label for="max_guests">Max Guests</label>
              @error('max_guests')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            {{-- Submit --}}
            <div class="d-grid mt-4">
              <button type="submit" class="btn btn-lg btn-primary" style="background-color: #FF385C; border:none;">
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
