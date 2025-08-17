@extends('admin.layouts.admin')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">Edit Property</h2>
    <form class="bg-white shadow p-4 rounded w-1/2">
        <label class="block mb-2">Title</label>
        <input type="text" class="w-full border p-2 mb-4" value="Luxury Villa">

        <label class="block mb-2">Location</label>
        <input type="text" class="w-full border p-2 mb-4" value="Paris">

        <label class="block mb-2">Price</label>
        <input type="text" class="w-full border p-2 mb-4" value="$500">

        <label class="block mb-2">Status</label>
        <select class="w-full border p-2 mb-4">
            <option>Active</option>
            <option>Inactive</option>
        </select>

        <button class="bg-green-500 text-white px-4 py-2 rounded">Save</button>
    </form>
</div>
@endsection
