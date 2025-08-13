@extends('layouts.app')

@section('title', 'Booking Details')

@section('content')
<div class="container py-5">

  {{-- Page Header --}}
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h2 class="fw-bold" style="color: var(--primary-color);">Booking Details</h2>
      <p class="text-muted mb-0">Review all details and manage this reservation</p>
    </div>
    <a href="{{ route('booking.index') }}" class="btn btn-outline-secondary">Back to Bookings</a>
  </div>

  {{-- Booking Details Card --}}
  <div class="card border-0 shadow-sm rounded-4 p-4">
    
    {{-- Top Summary --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
      <div>
        <h5 class="fw-bold mb-1"><i class="bi bi-receipt"></i> Booking #12345</h5>
        <span class="badge bg-warning text-dark">Pending</span>
      </div>
      <div class="text-end">
        <h4 class="fw-bold mb-0" style="color: var(--primary-color);"><i class="bi bi-currency-dollar"></i> $750</h4>
        <small class="text-muted">Total Price</small>
      </div>
    </div>

    {{-- Info Grid --}}
    <div class="row g-4">
      
      {{-- Booking Info --}}
      <div class="col-md-6">
        <h6 class="fw-bold mb-3" style="color: var(--primary-color);"><i class="bi bi-calendar-check"></i> Booking Info</h6>
        <p class="mb-2"><i class="bi bi-box-arrow-in-right"></i> <strong>Check-In:</strong> Aug 20, 2025</p>
        <p class="mb-2"><i class="bi bi-box-arrow-in-left"></i> <strong>Check-Out:</strong> Aug 25, 2025</p>
        <p class="mb-2"><i class="bi bi-moon-stars"></i> <strong>Total Nights:</strong> 5</p>
        <p class="mb-2"><i class="bi bi-people-fill"></i> <strong>Guests:</strong> 2</p>
      </div>

      {{-- Guest Info --}}
      <div class="col-md-6">
        <h6 class="fw-bold mb-3" style="color: var(--primary-color);"><i class="bi bi-person-badge"></i> Guest Details</h6>
        <p class="mb-2"><i class="bi bi-person-fill"></i> <strong>Name:</strong> John Doe</p>
        <p class="mb-2"><i class="bi bi-envelope-fill"></i> <strong>Email:</strong> john@example.com</p>
        <p class="mb-2"><i class="bi bi-telephone-fill"></i> <strong>Phone:</strong> +1 234 567 890</p>
        <p class="mb-2"><i class="bi bi-chat-left-text-fill"></i> <strong>Special Requests:</strong> Vegetarian breakfast</p>
      </div>

      {{-- Property Info --}}
      <div class="col-12">
        <h6 class="fw-bold mb-3" style="color: var(--primary-color);"><i class="bi bi-house-fill"></i> Property Info</h6>
        <div class="d-flex flex-wrap align-items-center gap-3">
          <img src="https://via.placeholder.com/350x200" alt="Property Image" class="img-fluid rounded-3" style="max-width: 350px;">
          <div>
            <p class="fw-bold mb-1">Cozy Beachside Villa</p>
            <p class="text-muted mb-2"><i class="bi bi-geo-alt-fill"></i> 123 Ocean Drive, Miami, United States</p>
            <a href="#" class="btn btn-sm btn-outline-primary" style="color: var(--primary-color); border-color: var(--primary-color);">
              View Property
            </a>
          </div>
        </div>
      </div>

    </div>

    {{-- Host Action Buttons --}}
    <div class="d-flex justify-content-end gap-3 mt-4">
      <a href="#" class="btn btn-success px-4" style="background-color: #28a745; border: none;">
        <i class="bi bi-check-circle-fill"></i> Accept Booking
      </a>
      <a href="#" class="btn btn-danger px-4">
        <i class="bi bi-x-circle-fill"></i> Decline Booking
      </a>
    </div>

  </div>
</div>
@endsection
