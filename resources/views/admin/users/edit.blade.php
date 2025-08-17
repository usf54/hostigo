@extends('admin.layouts.admin')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">Edit User</h2>
    <form class="bg-white shadow p-4 rounded w-1/2">
        <label class="block mb-2">Name</label>
        <input type="text" class="w-full border p-2 mb-4" value="John Doe">

        <label class="block mb-2">Email</label>
        <input type="email" class="w-full border p-2 mb-4" value="john@example.com">

        <label class="block mb-2">Role</label>
        <select class="w-full border p-2 mb-4">
            <option>User</option>
            <option>Admin</option>
        </select>

        <button class="bg-green-500 text-white px-4 py-2 rounded">Save</button>
    </form>
</div>
@endsection
