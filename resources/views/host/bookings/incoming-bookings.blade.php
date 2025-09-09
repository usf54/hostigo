@extends('layouts.app')

@section('title', 'Incoming Bookings')

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
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h2 class="fw-bold mb-1" style="color: #FF385C;">Incoming Bookings</h2>
      <p class="text-muted mb-0">View and manage all your upcoming reservations</p>
    </div>
  </div>

  {{-- Filters --}}
  <div class="card border-0 shadow-sm rounded-4 mb-4 p-3">
    <form method="GET" class="row g-3">
      <div class="col-md-4">
        <label for="status" class="form-label fw-semibold">Status</label>
        <select id="status" name="status" class="form-select">
          <option {{ request('status') == 'All' ? 'selected' : '' }}>All</option>
          <option {{ request('status') == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
          <option {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
          <option {{ request('status') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
        </select>
      </div>

      <div class="col-md-4">
        <label for="fromDate" class="form-label fw-semibold">From Date</label>
        <input type="date" id="fromDate" name="fromDate" value="{{ request('fromDate') }}" class="form-control">
      </div>

      <div class="col-md-4">
        <label for="toDate" class="form-label fw-semibold">To Date</label>
        <input type="date" id="toDate" name="toDate" value="{{ request('toDate') }}" class="form-control">
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
          @forelse($bookings as $booking)
            <tr>
              <td>{{ $booking->guest->name }}</td>
              <td>{{ $booking->property->title }}</td>
              <td>{{ $booking->check_in }}</td>
              <td>{{ $booking->check_out }}</td>
              <td>${{ number_format($booking->total_price, 2) }}</td>
              <td>
                @if($booking->status === 'confirmed')
                  <span class="badge bg-success">Confirmed</span>
                @elseif($booking->status === 'pending')
                  <span class="badge bg-warning text-dark">Pending</span>
                @else
                  <span class="badge bg-danger">Cancelled</span>
                @endif
              </td>
              <td class="text-end">
                <button class="btn btn-sm btn-outline-info">
                  <a href="{{ route('host.bookings.show',$booking->id) }}" class='link'>View</a>
                </button>
                @if($booking->status === 'pending')
                  <form action="{{ route('host.bookings.approve', $booking) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-sm btn-outline-success">Approve</button>
                  </form>
                  <form action="{{ route('host.bookings.decline', $booking) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-sm btn-outline-danger">Decline</button>
                  </form>
                @else
                  <span class="text-muted">No actions</span>
                @endif
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="text-center text-muted py-4">No bookings found.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
