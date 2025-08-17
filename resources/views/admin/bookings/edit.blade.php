@extends('admin.layouts.admin')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">Edit Booking</h2>
    <form class="bg-white shadow p-4 rounded w-1/2">
        <label class="block mb-2">User</label>
        <input type="text" class="w-full border p-2 mb-4" value="John Doe">

        <label class="block mb-2">Property</label>
        <input type="text" class="w-full border p-2 mb-4" value="Luxury Villa">

        <label class="block mb-2">Date</label>
        <input type="date" class="w-full border p-2 mb-4" value="2025-08-17">

        <label class="block mb-2">Status</label>
        <select class="w-full border p-2 mb-4">
            <option>Confirmed</option>
            <option>Pending</option>
            <option>Cancelled</option>
        </select>

        <button class="bg-green-500 text-white px-4 py-2 rounded">Save</button>
    </form>
</div>
@endsection
