@extends('admin.layouts.admin')

@section('content')
<div class="p-4">

    <!-- Page Heading -->
    <h2 class="mb-4" style="font-size:1.8rem; font-weight:700; color:#1E1E2F;">Users</h2>

    <!-- Users Table -->
    <div class="table-responsive shadow-sm rounded">
        <table class="table align-middle mb-0" style="width:100%; border-collapse: separate; border-spacing:0;">
            <thead style="background:#FF385C; color:#fff;">
                <tr>
                    <th class="py-2 px-3 text-center">ID</th>
                    <th class="py-2 px-3">Name</th>
                    <th class="py-2 px-3">Email</th>
                    <th class="py-2 px-3">Role</th>
                    <th class="py-2 px-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr class="align-middle border-bottom" style="transition:background 0.2s;">
                        <td class="py-2 px-3 text-center">{{ $user->id }}</td>
                        <td class="py-2 px-3">{{ $user->name }}</td>
                        <td class="py-2 px-3">{{ $user->email }}</td>
                        <td class="py-2 px-3">{{ ucfirst($user->role) }}</td>
                        <td class="py-2 px-3 text-center">
                            <!-- Show User -->
                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-info me-1" title="View">
                                <i class="fas fa-eye"></i>
                            </a>

                            <!-- Edit User -->
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-success me-1" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>

                            <!-- Delete User -->
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this user?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-3 text-muted">No users found.</td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

</div>
<!-- Delete Confirmation Script -->
<script>
function confirmDelete(button){
    if(confirm("Are you sure you want to delete this property?")){
        // Example: submit a form or make an AJAX request here
        alert("Deleted!"); // Replace with actual delete action
    }
}
</script>
@endsection
