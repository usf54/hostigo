@extends('admin.layouts.admin')

@section('content')
<div class="p-4">
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
    <!-- Page Heading -->
    <h2 class="mb-4" style="font-size:1.8rem; font-weight:700; color:#1E1E2F;">Bookings</h2>

    <!-- Bookings Table -->
    <div class="table-responsive shadow-sm rounded">
        <table class="table align-middle mb-0" style="width:100%; border-collapse: separate; border-spacing:0;">
            <thead style="background:#FF385C; color:#fff;">
                <tr>
                    <th class="py-2 px-3 text-center">ID</th>
                    <th class="py-2 px-3">Guest</th>
                    <th class="py-2 px-3">Property</th>
                    <th class="py-2 px-3">Check-In / Check-Out</th>
                    <th class="py-2 px-3">Status</th>
                    <th class="py-2 px-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $booking)
                <tr class="align-middle border-bottom" style="transition:background 0.2s;">
                    <td class="py-2 px-3 text-center">{{ $booking->id }}</td>
                    <td class="py-2 px-3">{{ $booking->guest->name ?? 'N/A' }}</td>
                    <td class="py-2 px-3">{{ $booking->property->title ?? 'N/A' }}</td>
                    <td class="py-2 px-3">
                        {{ $booking->check_in }} → {{ $booking->check_out }}
                    </td>
                    <td class="py-2 px-3">
                        @if($booking->status == 'confirmed')
                            <span class="badge bg-success">Confirmed</span>
                        @elseif($booking->status == 'pending')
                            <span class="badge bg-warning text-dark">Pending</span>
                        @else
                            <span class="badge bg-danger">Cancelled</span>
                        @endif
                    </td>
                    <td class="py-2 px-3 text-center">
                        <a href="{{ route('bookings.show', $booking->id) }}" class="btn btn-sm btn-info me-1" title="View">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-sm btn-success me-1" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this booking?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-3">No bookings found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
