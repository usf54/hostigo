@extends('admin.layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <!-- Users -->
    <div class="col-md-3 mb-4">
        <div class="card dashboard-card text-center">
            <div class="card-body">
                <div class="icon-wrapper mb-3">
                    <i class="fas fa-users"></i>
                </div>
                <h6 class="card-title">Users</h6>
                <h3 class="card-value">120</h3>
            </div>
        </div>
    </div>

    <!-- Properties -->
    <div class="col-md-3 mb-4">
        <div class="card dashboard-card text-center">
            <div class="card-body">
                <div class="icon-wrapper mb-3">
                    <i class="fas fa-building"></i>
                </div>
                <h6 class="card-title">Properties</h6>
                <h3 class="card-value">45</h3>
            </div>
        </div>
    </div>

    <!-- Bookings -->
    <div class="col-md-3 mb-4">
        <div class="card dashboard-card text-center">
            <div class="card-body">
                <div class="icon-wrapper mb-3">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <h6 class="card-title">Bookings</h6>
                <h3 class="card-value">230</h3>
            </div>
        </div>
    </div>

    <!-- Revenue -->
    <div class="col-md-3 mb-4">
        <div class="card dashboard-card text-center">
            <div class="card-body">
                <div class="icon-wrapper mb-3">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <h6 class="card-title">Revenue</h6>
                <h3 class="card-value">$12,500</h3>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    