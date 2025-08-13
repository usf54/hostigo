@extends('layouts.app')

@section('title', 'My Properties')

@section('content')
<div class="container py-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h2 class="fw-bold mb-1" style="color: #FF385C;">My Properties</h2>
      <p class="text-muted mb-0">Manage your listings and keep them up to date</p>
    </div>
    <a href="{{ route('property.create') }}" class="btn btn-primary px-4" style="background-color: #FF385C; border: none;">
      + Add New Property
    </a>
  </div>

  {{-- Properties List --}}
  <div class="row g-4">
    {{-- Property Card --}}
    <div class="col-md-6 col-lg-4">
      <a href="{{ route('property.show') }}" class='nav-link'>
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
          <div class="position-relative">
            <img src="https://via.placeholder.com/600x400" class="card-img-top" alt="Property Image">
            <span class="badge position-absolute top-0 start-0 m-2 bg-light text-dark fw-semibold px-3 py-2">
              $150 / night
            </span>
          </div>
          <div class="card-body">
            <h5 class="card-title fw-bold mb-1">Cozy Beachside Villa</h5>
            <p class="text-muted mb-2">Miami, United States</p>
            <p class="small text-muted">Max Guests: 4</p>
            <div class="d-flex gap-2 mt-3">
              <a href="#" class="btn btn-sm btn-outline-primary" style="border-color: #FF385C; color: #FF385C;">
                Edit
              </a>
              <a href="#" class="btn btn-sm btn-outline-danger">
                Delete
              </a>
            </div>
          </div>
        </div>
      </a>
    </div>

    {{-- Another Property --}}
    <div class="col-md-6 col-lg-4">
      <a href="{{ route('property.show') }}" class='nav-link'>
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
          <div class="position-relative">
            <img src="https://via.placeholder.com/600x400" class="card-img-top" alt="Property Image">
            <span class="badge position-absolute top-0 start-0 m-2 bg-light text-dark fw-semibold px-3 py-2">
              $200 / night
            </span>
          </div>
          <div class="card-body">
            <h5 class="card-title fw-bold mb-1">Luxury City Apartment</h5>
            <p class="text-muted mb-2">New York, United States</p>
            <p class="small text-muted">Max Guests: 2</p>
            <div class="d-flex gap-2 mt-3">
              <a href="#" class="btn btn-sm btn-outline-primary" style="border-color: #FF385C; color: #FF385C;">
                Edit
              </a>
              <a href="#" class="btn btn-sm btn-outline-danger">
                Delete
              </a>
            </div>
          </div>
        </div>
      </a>
    </div>

    {{-- Example Empty State --}}
    {{-- <div class="col-12">
      <div class="text-center text-muted py-5">
        <p class="mb-3">You haven't listed any properties yet.</p>
        <a href="{{ route('property.create') }}" class="btn btn-primary" style="background-color: #FF385C; border: none;">
          Add Your First Property
        </a>
      </div>
    </div> --}}
  </div>
</div>
@endsection
