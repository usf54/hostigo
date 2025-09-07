@extends('admin.layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="row">
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
    <!-- Users -->
    <div class="col-md-3 mb-4">
        <a href="{{ route('users.index') }}" class="text-decoration-none">
            <div class="card dashboard-card text-center">
                <div class="card-body">
                    <div class="icon-wrapper mb-3">
                        <i class="fas fa-users"></i>
                    </div>
                    <h6 class="card-title">Users</h6>
                    <h3 class="card-value">{{ $usersCount }}</h3>
                </div>
            </div>
        </a>
    </div>

    <!-- Properties -->
    <div class="col-md-3 mb-4">
        <a href="{{ route('properties.index') }}" class="text-decoration-none">
            <div class="card dashboard-card text-center">
                <div class="card-body">
                    <div class="icon-wrapper mb-3">
                        <i class="fas fa-building"></i>
                    </div>
                    <h6 class="card-title">Properties</h6>
                    <h3 class="card-value">{{ $propertiesCount }}</h3>
                </div>
            </div>
        </a>
    </div>

    <!-- Bookings -->
    <div class="col-md-3 mb-4">
        <a href="{{ route('bookings.index') }}" class="text-decoration-none">
            <div class="card dashboard-card text-center">
                <div class="card-body">
                    <div class="icon-wrapper mb-3">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h6 class="card-title">Bookings</h6>
                    <h3 class="card-value">{{ $bookingsCount }}</h3>
                </div>
            </div>
        </a>
    </div>

    <!-- Revenue -->
    <div class="col-md-3 mb-4">
        <a href="{{ route('payments.index') }}" class="text-decoration-none">
            <div class="card dashboard-card text-center">
                <div class="card-body">
                    <div class="icon-wrapper mb-3">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <h6 class="card-title">Revenue</h6>
                    <h3 class="card-value">${{ number_format($totalRevenue, 2) }}</h3>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection
