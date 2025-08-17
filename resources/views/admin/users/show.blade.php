@extends('admin.layouts.admin')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">User Details</h2>
    <div class="bg-white shadow p-4 rounded">
        <p><strong>Name:</strong> John Doe</p>
        <p><strong>Email:</strong> john@example.com</p>
        <p><strong>Role:</strong> User</p>
    </div>
    <div class="mt-4">
        <a href="#" class="bg-blue-500 text-white px-4 py-2 rounded">Back</a>
    </div>
</div>
@endsection
