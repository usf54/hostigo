@extends('admin.layouts.admin')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">Property Details</h2>
    <div class="bg-white shadow p-4 rounded">
        <p><strong>Title:</strong> Luxury Villa</p>
        <p><strong>Location:</strong> Paris</p>
        <p><strong>Price:</strong> $500</p>
        <p><strong>Status:</strong> Active</p>
    </div>
    <div class="mt-4">
        <a href="#" class="bg-blue-500 text-white px-4 py-2 rounded">Back</a>
    </div>
</div>
@endsection
