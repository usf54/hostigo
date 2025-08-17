@extends('admin.layouts.admin')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">Payments</h2>
    <table class="w-full border-collapse border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">ID</th>
                <th class="border p-2">User</th>
                <th class="border p-2">Property</th>
                <th class="border p-2">Amount</th>
                <th class="border p-2">Date</th>
                <th class="border p-2">Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="border p-2">1</td>
                <td class="border p-2">John Doe</td>
                <td class="border p-2">Luxury Villa</td>
                <td class="border p-2">$500</td>
                <td class="border p-2">2025-08-17</td>
                <td class="border p-2">Paid</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
