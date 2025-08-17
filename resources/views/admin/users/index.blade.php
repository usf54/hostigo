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
                <tr class="align-middle border-bottom" style="transition:background 0.2s;">
                    <td class="py-2 px-3 text-center">1</td>
                    <td class="py-2 px-3">John Doe</td>
                    <td class="py-2 px-3">john@example.com</td>
                    <td class="py-2 px-3">User</td>
                    <td class="py-2 px-3 text-center">
                        <a href="#" class="btn btn-sm btn-info me-1"><i class="fas fa-eye"></i></a>
                        <a href="#" class="btn btn-sm btn-success me-1"><i class="fas fa-edit"></i></a>
                        <a href="#" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                <tr class="align-middle border-bottom" style="transition:background 0.2s;">
                    <td class="py-2 px-3 text-center">2</td>
                    <td class="py-2 px-3">Jane Smith</td>
                    <td class="py-2 px-3">jane@example.com</td>
                    <td class="py-2 px-3">Admin</td>
                    <td class="py-2 px-3 text-center">
                        <a href="#" class="btn btn-sm btn-info me-1"><i class="fas fa-eye"></i></a>
                        <a href="#" class="btn btn-sm btn-success me-1"><i class="fas fa-edit"></i></a>
                        <button class="btn btn-sm btn-danger" title="Delete" onclick="confirmDelete(this)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                <!-- Repeat for more users -->
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
