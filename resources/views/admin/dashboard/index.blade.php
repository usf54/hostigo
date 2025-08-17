@extends('admin.layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">Users</h5>
                <p class="card-text display-6">120</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">Properties</h5>
                <p class="card-text display-6">45</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">Bookings</h5>
                <p class="card-text display-6">230</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">Revenue</h5>
                <p class="card-text display-6">$12,500</p>
            </div>
        </div>
    </div>
</div>
@endsection
