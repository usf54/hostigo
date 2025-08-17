@extends('admin.layouts.admin')

@section('content')
<div class="p-4">

    <!-- Page Heading -->
    <h2 class="mb-4" style="font-size:1.8rem; font-weight:700; color:#1E1E2F;">Reports & Analytics</h2>

    <!-- Summary Cards -->
    <div class="row g-4">
        <div class="col-md-3">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <i class="fas fa-users fa-2x mb-2" style="color:#FF385C;"></i>
                    <h6 class="card-title">Total Users</h6>
                    <p class="card-value fs-3 fw-bold">120</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <i class="fas fa-building fa-2x mb-2" style="color:#FF385C;"></i>
                    <h6 class="card-title">Total Properties</h6>
                    <p class="card-value fs-3 fw-bold">45</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <i class="fas fa-calendar-check fa-2x mb-2" style="color:#FF385C;"></i>
                    <h6 class="card-title">Total Bookings</h6>
                    <p class="card-value fs-3 fw-bold">300</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <i class="fas fa-dollar-sign fa-2x mb-2" style="color:#FF385C;"></i>
                    <h6 class="card-title">Total Revenue</h6>
                    <p class="card-value fs-3 fw-bold">$25,000</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Bookings Table -->
    <div class="mt-4 card shadow-sm">
        <div class="card-body">
            <h5 class="card-title mb-3">Recent Bookings</h5>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead style="background:#FF385C; color:#fff;">
                        <tr>
                            <th class="py-2 px-3 text-center">Booking ID</th>
                            <th class="py-2 px-3">User</th>
                            <th class="py-2 px-3">Property</th>
                            <th class="py-2 px-3">Date</th>
                            <th class="py-2 px-3 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-bottom align-middle">
                            <td class="py-2 px-3 text-center">1</td>
                            <td class="py-2 px-3">John Doe</td>
                            <td class="py-2 px-3">Luxury Villa</td>
                            <td class="py-2 px-3">2025-08-17</td>
                            <td class="py-2 px-3 text-center">
                                <span class="badge bg-success">Confirmed</span>
                            </td>
                        </tr>
                        <tr class="border-bottom align-middle">
                            <td class="py-2 px-3 text-center">2</td>
                            <td class="py-2 px-3">Jane Smith</td>
                            <td class="py-2 px-3">Beach House</td>
                            <td class="py-2 px-3">2025-08-16</td>
                            <td class="py-2 px-3 text-center">
                                <span class="badge bg-warning text-dark">Pending</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
@endsection
