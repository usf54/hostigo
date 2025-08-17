<div class="bg-white border-end" id="sidebar-wrapper" style="width:250px; min-height:100vh;">
    <div class="sidebar-heading text-center py-4">
        <h4 style="color: var(--primary-color);">Admin Panel</h4>
    </div>
    <div class="list-group list-group-flush">
        <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action">Dashboard</a>
        <a href="{{ route('admin.users.index') }}" class="list-group-item list-group-item-action">Users</a>
        <a href="{{ route('admin.properties.index') }}" class="list-group-item list-group-item-action">Properties</a>
        <a href="{{ route('admin.bookings.index') }}" class="list-group-item list-group-item-action">Bookings</a>
        <a href="{{ route('admin.payments.index') }}" class="list-group-item list-group-item-action">Payments</a>
        <a href="{{ route('admin.reports.index') }}" class="list-group-item list-group-item-action">Reports</a>
        <a href="{{ route('admin.settings.index') }}" class="list-group-item list-group-item-action">Settings</a>
    </div>
</div>
