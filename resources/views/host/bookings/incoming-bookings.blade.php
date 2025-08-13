@extends('layouts.app')

@section('title', 'Incoming Bookings')

@section('content')
<div class="container py-5">
  
  {{-- Header --}}
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h2 class="fw-bold mb-1" style="color: #FF385C;">Incoming Bookings</h2>
      <p class="text-muted mb-0">View and manage all your upcoming reservations</p>
    </div>
  </div>

  {{-- Filters --}}
  <div class="card border-0 shadow-sm rounded-4 mb-4 p-3">
    <form class="row g-3">
      <div class="col-md-4">
        <label for="status" class="form-label fw-semibold">Status</label>
        <select id="status" class="form-select">
          <option selected>All</option>
          <option>Confirmed</option>
          <option>Pending</option>
          <option>Cancelled</option>
        </select>
      </div>

      <div class="col-md-4">
        <label for="fromDate" class="form-label fw-semibold">From Date</label>
        <input type="date" id="fromDate" class="form-control">
      </div>

      <div class="col-md-4">
        <label for="toDate" class="form-label fw-semibold">To Date</label>
        <input type="date" id="toDate" class="form-control">
      </div>

      <div class="col-12 text-end">
        <button type="submit" class="btn btn-primary px-4" style="background-color: #FF385C; border: none;">
          Filter
        </button>
      </div>
    </form>
  </div>

  {{-- Bookings Table --}}
  <div class="card border-0 shadow-sm rounded-4">
    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0">
        <thead class="table-light">
          <tr>
            <th>Guest</th>
            <th>Property</th>
            <th>Check-In</th>
            <th>Check-Out</th>
            <th>Total Price</th>
            <th>Status</th>
            <th class="text-end">Actions</th>
          </tr>
        </thead>
        <tbody>
          {{-- Booking Row --}}
          <tr>
            <td>John Doe</td>
            <td>Cozy Beachside Villa</td>
            <td>2025-08-20</td>
            <td>2025-08-25</td>
            <td>$750</td>
            <td>
              <span class="badge bg-success">Confirmed</span>
            </td>
            <td class="text-end">
              <a href="{{ route('booking.show') }}" class="btn btn-sm btn-outline-primary" style="border-color: #FF385C; color: #FF385C;">
                View
              </a>
              <a href="#" class="btn btn-sm btn-outline-danger">
                Cancel
              </a>
            </td>
          </tr>

          {{-- Another Booking --}}
          <tr>
            <td>Jane Smith</td>
            <td>Luxury City Apartment</td>
            <td>2025-09-01</td>
            <td>2025-09-05</td>
            <td>$800</td>
            <td>
              <span class="badge bg-warning text-dark">Pending</span>
            </td>
            <td class="text-end">
              <a href="{{ route('booking.show') }}" class="btn btn-sm btn-outline-primary" style="border-color: #FF385C; color: #FF385C;">
                View
              </a>
              <a href="#" class="btn btn-sm btn-outline-danger">
                Cancel
              </a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

</div>
@endsection
