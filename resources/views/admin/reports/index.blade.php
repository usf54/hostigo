@extends('admin.layouts.admin')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold mb-6">Reports & Analytics</h2>

    <div class="grid grid-cols-2 gap-6">
        <!-- Total Users -->
        <div class="bg-white p-6 shadow rounded">
            <h3 class="text-lg font-semibold mb-2">Total Users</h3>
            <p class="text-3xl font-bold">120</p>
        </div>

        <!-- Total Properties -->
        <div class="bg-white p-6 shadow rounded">
            <h3 class="text-lg font-semibold mb-2">Total Properties</h3>
            <p class="text-3xl font-bold">45</p>
        </div>

        <!-- Total Bookings -->
        <div class="bg-white p-6 shadow rounded">
            <h3 class="text-lg font-semibold mb-2">Total Bookings</h3>
            <p class="text-3xl font-bold">300</p>
        </div>

        <!-- Total Revenue -->
        <div class="bg-white p-6 shadow rounded">
            <h3 class="text-lg font-semibold mb-2">Total Revenue</h3>
            <p class="text-3xl font-bold">$25,000</p>
        </div>
    </div>

    <div class="mt-8 bg-white p-6 shadow rounded">
        <h3 class="text-lg font-semibold mb-4">Recent Bookings</h3>
        <table class="w-full border-collapse border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border p-2">Booking ID</th>
                    <th class="border p-2">User</th>
                    <th class="border p-2">Property</th>
                    <th class="border p-2">Date</th>
                    <th class="border p-2">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border p-2">1</td>
                    <td class="border p-2">John Doe</td>
                    <td class="border p-2">Luxury Villa</td>
                    <td class="border p-2">2025-08-17</td>
                    <td class="border p-2">Confirmed</td>
                </tr>
                <tr>
                    <td class="border p-2">2</td>
                    <td class="border p-2">Jane Smith</td>
                    <td class="border p-2">Beach House</td>
                    <td class="border p-2">2025-08-16</td>
                    <td class="border p-2">Pending</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
