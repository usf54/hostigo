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
    <h2 class="mb-4" style="font-size:1.8rem; font-weight:700; color:#1E1E2F;">Payments</h2>

    <!-- Payments Table -->
    <div class="table-responsive shadow-sm rounded">
        <table class="table align-middle mb-0" style="width:100%; border-collapse: separate; border-spacing:0;">
            <thead style="background:#FF385C; color:#fff;">
                <tr>
                    <th class="py-2 px-3 text-center">ID</th>
                    <th class="py-2 px-3">User</th>
                    <th class="py-2 px-3">Property</th>
                    <th class="py-2 px-3">Amount</th>
                    <th class="py-2 px-3">Date</th>
                    <th class="py-2 px-3 text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr class="align-middle border-bottom" style="transition:background 0.2s;">
                    <td class="py-2 px-3 text-center">1</td>
                    <td class="py-2 px-3">John Doe</td>
                    <td class="py-2 px-3">Luxury Villa</td>
                    <td class="py-2 px-3">$500</td>
                    <td class="py-2 px-3">2025-08-17</td>
                    <td class="py-2 px-3 text-center">
                        <span class="badge bg-success">Paid</span>
                    </td>
                </tr>
                <tr class="align-middle border-bottom" style="transition:background 0.2s;">
                    <td class="py-2 px-3 text-center">2</td>
                    <td class="py-2 px-3">Jane Smith</td>
                    <td class="py-2 px-3">Modern Apartment</td>
                    <td class="py-2 px-3">$350</td>
                    <td class="py-2 px-3">2025-08-20</td>
                    <td class="py-2 px-3 text-center">
                        <span class="badge bg-warning text-dark">Pending</span>
                    </td>
                </tr>
                <tr class="align-middle border-bottom" style="transition:background 0.2s;">
                    <td class="py-2 px-3 text-center">3</td>
                    <td class="py-2 px-3">Alice Johnson</td>
                    <td class="py-2 px-3">Beach House</td>
                    <td class="py-2 px-3">$700</td>
                    <td class="py-2 px-3">2025-08-21</td>
                    <td class="py-2 px-3 text-center">
                        <span class="badge bg-danger">Failed</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
@endsection
