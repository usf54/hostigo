@extends('layouts.app')

@section('title', 'Property Details')

@section('content')
<div class="container py-5">
  <div class="row g-4">
    {{-- Property Images --}}
    <div class="col-lg-7">
      <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
        <img src="https://via.placeholder.com/900x500" class="img-fluid w-100" alt="Main Property Image">
      </div>
      <div class="d-flex gap-3">
        <img src="https://via.placeholder.com/150x100" class="img-thumbnail rounded-3" alt="Thumbnail">
        <img src="https://via.placeholder.com/150x100" class="img-thumbnail rounded-3" alt="Thumbnail">
        <img src="https://via.placeholder.com/150x100" class="img-thumbnail rounded-3" alt="Thumbnail">
      </div>
    </div>

    {{-- Property Details --}}
    <div class="col-lg-5">
      <div class="card border-0 shadow-sm rounded-4 p-4">
        <h2 class="fw-bold" style="color: #FF385C;">Cozy Beachside Villa</h2>
        <p class="text-muted mb-2">Miami, United States</p>
        <p class="mb-4">
          Experience breathtaking ocean views and direct beach access. This villa offers a private pool,
          modern amenities, and unforgettable sunsets.
        </p>

        <div class="mb-3">
          <strong>Price per Night:</strong>
          <span class="ms-2" style="color: #FF385C;">$150</span>
        </div>

        <div class="mb-3">
          <strong>Max Guests:</strong>
          <span class="ms-2">4</span>
        </div>

        <div class="mb-3">
          <strong>Address:</strong>
          <span class="ms-2">123 Ocean Drive, Miami, United States</span>
        </div>

        <div class="mb-3">
          <strong>Coordinates:</strong>
          <span class="ms-2">Lat: 25.7617, Lng: -80.1918</span>
        </div>

        <hr>

        <div class="d-flex gap-3 mt-4">
          <a href="#" class="btn btn-primary px-4" style="background-color: #FF385C; border: none;">
            Edit Property
          </a>
          <a href="#" class="btn btn-outline-danger px-4">
            Remove Property
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
