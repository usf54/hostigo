@extends('admin.layouts.admin')

@section('content')
<div class="p-6 max-w-lg">
    <h2 class="text-2xl font-bold mb-4">Admin Settings</h2>
    <form class="bg-white shadow p-4 rounded space-y-4">
        <div>
            <label class="block mb-1 font-medium">Site Name</label>
            <input type="text" class="w-full border p-2" value="Property Booking Platform">
        </div>
        <div>
            <label class="block mb-1 font-medium">Site Email</label>
            <input type="email" class="w-full border p-2" value="admin@example.com">
        </div>
        <div>
            <label class="block mb-1 font-medium">Timezone</label>
            <select class="w-full border p-2">
                <option>UTC</option>
                <option>GMT</option>
                <option>EST</option>
            </select>
        </div>
        <div>
            <label class="block mb-1 font-medium">Site Logo</label>
            <input type="file" class="w-full">
        </div>
        <button class="bg-green-500 text-white px-4 py-2 rounded">Save Settings</button>
    </form>
</div>
@endsection
