@extends('layouts.app')

@section('title', 'Booking Details')

@section('content')
<div class="container py-5">
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
  {{-- Page Header --}}
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h2 class="fw-bold" style="color: var(--primary-color);">Booking Details</h2>
      <p class="text-muted mb-0">Review all details and manage this reservation</p>
    </div>
    <a href="{{ route('host.bookings.index') }}" class="btn btn-outline-secondary">Back to Bookings</a>
  </div>

  {{-- Booking Details Card --}}
  <div class="card border-0 shadow-sm rounded-4 p-4">
    
    {{-- Top Summary --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
      <div>
        <h5 class="fw-bold mb-1">
          <i class="bi bi-receipt"></i> Booking #{{ $booking->id }}
        </h5>
        <span class="badge
          @if($booking->status == 'confirmed') bg-success
          @elseif($booking->status == 'cancelled') bg-danger
          @else bg-warning text-dark @endif">
          {{ ucfirst($booking->status) }}
        </span>
      </div>
      <div class="text-end">
        <h4 class="fw-bold mb-0" style="color: var(--primary-color);">
          <i class="bi bi-currency-dollar"></i> {{ number_format($booking->total_price, 2) }}$
        </h4>
        <small class="text-muted">Total Price</small>
      </div>
    </div>

    {{-- Info Grid --}}
    <div class="row g-4">
      
      {{-- Booking Info --}}
      <div class="col-md-6">
        <h6 class="fw-bold mb-3" style="color: var(--primary-color);">
          <i class="bi bi-calendar-check"></i> Booking Info
        </h6>
        <p class="mb-2"><i class="bi bi-box-arrow-in-right"></i>
          <strong>Check-In:</strong> {{ \Carbon\Carbon::parse($booking->check_in)->format('M d, Y') }}
        </p>
        <p class="mb-2"><i class="bi bi-box-arrow-in-left"></i>
          <strong>Check-Out:</strong> {{ \Carbon\Carbon::parse($booking->check_out)->format('M d, Y') }}
        </p>
        <p class="mb-2"><i class="bi bi-moon-stars"></i>
          <strong>Total Nights:</strong>
          {{ \Carbon\Carbon::parse($booking->check_in)->diffInDays(\Carbon\Carbon::parse($booking->check_out)) }}
        </p>
        <p class="mb-2"><i class="bi bi-people-fill"></i>
          <strong>Guests:</strong> {{ $booking->property->max_guests ?? 'N/A' }}
        </p>
      </div>

      {{-- Guest Info --}}
      <div class="col-md-6">
        <h6 class="fw-bold mb-3" style="color: var(--primary-color);">
          <i class="bi bi-person-badge"></i> Guest Details
        </h6>
        <p class="mb-2"><i class="bi bi-person-fill"></i>
          <strong>Name:</strong> {{ $booking->guest->name }}
        </p>
        <p class="mb-2"><i class="bi bi-envelope-fill"></i>
          <strong>Email:</strong> {{ $booking->guest->email }}
        </p>
        <p class="mb-2"><i class="bi bi-telephone-fill"></i>
          <strong>Phone:</strong> {{ $booking->guest->phone ?? 'Not provided' }}
        </p>
      </div>

      {{-- Property Info --}}
      <div class="col-12">
        <h6 class="fw-bold mb-3" style="color: var(--primary-color);">
          <i class="bi bi-house-fill"></i> Property Info
        </h6>
        <div class="d-flex flex-wrap align-items-center gap-3">
          <img
            src="{{ $booking->property->images->first()->url ?? 'https://via.placeholder.com/350x200' }}" 
            alt="{{ $booking->property->title }}"
            class="img-fluid rounded-3"
            style="max-width: 350px;">
          <div>
            <p class="fw-bold mb-1">{{ $booking->property->title }}</p>
            <p class="text-muted mb-2">
              <i class="bi bi-geo-alt-fill"></i> 
              {{ $booking->property->address }}, {{ $booking->property->city }}, {{ $booking->property->country }}
            </p>
            <a href="{{ route('property.show', $booking->property->id) }}"
               class="btn btn-sm btn-outline-primary"
               style="color: var(--primary-color); border-color: var(--primary-color);">
              View Property
            </a>
          </div>
        </div>
      </div>

    </div>

    {{-- Host Action Buttons --}}
    <div class="d-flex justify-content-end gap-3 mt-4">
      @if($booking->status == 'pending')
        <form action="{{ route('host.bookings.approve', $booking->id) }}" method="POST">
          @csrf
          @method('PATCH')
          <button type="submit" class="btn btn-success px-4">
            <i class="bi bi-check-circle-fill"></i> Accept Booking
          </button>
        </form>
        <form action="{{ route('host.bookings.decline', $booking->id) }}" method="POST">
          @csrf
          @method('PATCH')
          <button type="submit" class="btn btn-danger px-4">
            <i class="bi bi-x-circle-fill"></i> Decline Booking
          </button>
        </form>
      @endif
    </div>
  </div>
</div>
@endsection
