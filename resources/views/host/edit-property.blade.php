@extends('layouts.app')

@section('title', 'Edit Property')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-8">

      <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white border-0 pb-0">
          <h2 class="fw-bold mb-0" style="color: #FF385C;">Edit Property</h2>
          <p class="text-muted mt-1 mb-4">Update your listing details</p>
        </div>

        <div class="card-body p-4">
          <form action="" method="POST" enctype="multipart/form-data" novalidate>
            @csrf
            {{-- If connected to backend: @method('PUT') --}}

            {{-- Title --}}
            <div class="form-floating mb-4">
              <input
                type="text"
                name="title"
                id="title"
                class="form-control"
                placeholder="Cozy Beachside Villa"
                value=""
                required
              >
              <label for="title">Property Title</label>
            </div>

            {{-- Description --}}
            <div class="form-floating mb-4">
              <textarea
                name="description"
                id="description"
                rows="5"
                class="form-control"
                placeholder="Describe your property and its unique features"
              ></textarea>
              <label for="description">Description</label>
            </div>

            {{-- Price per Night --}}
            <div class="form-floating mb-4">
              <input
                type="number"
                name="price_per_night"
                id="price_per_night"
                step="0.01"
                min="0"
                class="form-control"
                placeholder="150.00"
                value=""
                required
              >
              <label for="price_per_night">Price per Night (USD)</label>
            </div>

            {{-- Address --}}
            <div class="form-floating mb-4">
              <input
                type="text"
                name="address"
                id="address"
                class="form-control"
                placeholder="123 Ocean Drive"
                value=""
              >
              <label for="address">Address</label>
            </div>

            <div class="row g-3 mb-4">
              {{-- City --}}
              <div class="col-md-6">
                <div class="form-floating">
                  <input
                    type="text"
                    name="city"
                    id="city"
                    class="form-control"
                    placeholder="Miami"
                    value=""
                  >
                  <label for="city">City</label>
                </div>
              </div>

              {{-- Country --}}
              <div class="col-md-6">
                <div class="form-floating">
                  <input
                    type="text"
                    name="country"
                    id="country"
                    class="form-control"
                    placeholder="United States"
                    value=""
                  >
                  <label for="country">Country</label>
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
                    class="form-control"
                    placeholder="25.7617"
                    value=""
                  >
                  <label for="latitude">Latitude</label>
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
                    class="form-control"
                    placeholder="-80.1918"
                    value=""
                  >
                  <label for="longitude">Longitude</label>
                </div>
              </div>
            </div>

            {{-- Max Guests --}}
            <div class="form-floating mb-4">
              <input
                type="number"
                name="max_guests"
                id="max_guests"
                class="form-control"
                placeholder="1"
                min="1"
                value=""
              >
              <label for="max_guests">Max Guests</label>
            </div>

            {{-- Images --}}
            <div class="mb-4">
              <label class="form-label fw-semibold">Current Images</label>
              <div class="d-flex flex-wrap gap-2 mb-3">
                <div class="position-relative" style="width:120px;">
                  <img src="https://via.placeholder.com/120" class="img-fluid rounded" alt="Property Image">
                  <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1" title="Remove Image">
                    &times;
                  </button>
                </div>
                <div class="position-relative" style="width:120px;">
                  <img src="https://via.placeholder.com/120" class="img-fluid rounded" alt="Property Image">
                  <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1" title="Remove Image">
                    &times;
                  </button>
                </div>
              </div>
              <input type="file" name="images[]" class="form-control" multiple>
              <small class="text-muted">Leave empty to keep existing images.</small>
            </div>

            {{-- Submit --}}
            <div class="d-grid mt-4">
              <button type="submit" class="btn btn-lg btn-primary" style="background-color: #FF385C; border:none;">
                Update Property
              </button>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection
