@extends('admin.layouts.admin')

@section('content')
<div class="p-4">

    <!-- Page Heading -->
    <h2 class="mb-4" style="font-size:1.8rem; font-weight:700; color:#1E1E2F;">Properties</h2>

    <!-- Properties Table -->
    <div class="table-responsive shadow-sm rounded">
        <table class="table align-middle mb-0" style="width:100%; border-collapse: separate; border-spacing:0;">
            <thead style="background:#FF385C; color:#fff;">
                <tr>
                    <th class="py-2 px-3 text-center">ID</th>
                    <th class="py-2 px-3">Title</th>
                    <th class="py-2 px-3">Location</th>
                    <th class="py-2 px-3">Price</th>
                    <th class="py-2 px-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr class="align-middle border-bottom" style="transition:background 0.2s;">
                    <td class="py-2 px-3 text-center">1</td>
                    <td class="py-2 px-3">Luxury Villa</td>
                    <td class="py-2 px-3">Paris</td>
                    <td class="py-2 px-3">$500</td>
                    <td class="py-2 px-3 text-center">
                        <a href="#" class="btn btn-sm btn-info me-1" title="View"><i class="fas fa-eye"></i></a>
                        <a href="#" class="btn btn-sm btn-success me-1" title="Edit"><i class="fas fa-edit"></i></a>
                        <!-- Delete Button -->
                        <button class="btn btn-sm btn-danger" title="Delete" onclick="confirmDelete(this)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                <tr class="align-middle border-bottom" style="transition:background 0.2s;">
                    <td class="py-2 px-3 text-center">2</td>
                    <td class="py-2 px-3">Modern Apartment</td>
                    <td class="py-2 px-3">London</td>
                    <td class="py-2 px-3">$350</td>
                    <td class="py-2 px-3 text-center">
                        <a href="#" class="btn btn-sm btn-info me-1" title="View"><i class="fas fa-eye"></i></a>
                        <a href="#" class="btn btn-sm btn-success me-1" title="Edit"><i class="fas fa-edit"></i></a>
                        <button class="btn btn-sm btn-danger" title="Delete" onclick="confirmDelete(this)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                <!-- Repeat for more properties -->
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
