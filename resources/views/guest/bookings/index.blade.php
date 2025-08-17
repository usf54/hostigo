@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">My Bookings</h2>

    <!-- Filter Bar -->
    <div class="mb-4 row g-3">
        <div class="col-md-3">
            <label class="form-label fw-bold">Status</label>
            <select id="statusFilter" class="form-select">
                <option value="all">All</option>
                <option value="Confirmed">Confirmed</option>
                <option value="Pending">Pending</option>
                <option value="Cancelled">Cancelled</option>
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label fw-bold">City</label>
            <select id="cityFilter" class="form-select">
                <option value="all">All</option>
                <option value="Paris">Paris</option>
                <option value="Beach City">Beach City</option>
                <option value="Mountain Town">Mountain Town</option>
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label fw-bold">Date</label>
            <input type="date" id="dateFilter" class="form-control">
        </div>
        <div class="col-md-3 d-flex align-items-end">
            <button id="resetFilters" class="btn btn-primary w-100">Reset Filters</button>
        </div>
    </div>

    <div class="row g-4" id="bookingCards">
        <!-- Booking Card 1 -->
        <div class="col-md-6 col-lg-4 booking-card" data-status="Confirmed" data-city="Paris" data-date="2025-08-17">
            <div class="card shadow-sm">
                <img src="https://via.placeholder.com/400x250" class="card-img-top" alt="Luxury Villa">
                <div class="card-body">
                    <h5 class="card-title">Luxury Villa</h5>
                    <p class="card-text mb-1"><strong>Date:</strong> 2025-08-17</p>
                    <p class="card-text mb-1"><strong>City:</strong> Paris</p>
                    <p class="card-text mb-2"><strong>Booking ID:</strong> 1</p>
                    <span class="badge bg-success mb-3">Confirmed</span>
                    <a href="#" class="btn btn-primary float-end">View</a>
                </div>
            </div>
        </div>

        <!-- Booking Card 2 -->
        <div class="col-md-6 col-lg-4 booking-card" data-status="Pending" data-city="Beach City" data-date="2025-08-16">
            <div class="card shadow-sm">
                <img src="https://via.placeholder.com/400x250" class="card-img-top" alt="Beach House">
                <div class="card-body">
                    <h5 class="card-title">Beach House</h5>
                    <p class="card-text mb-1"><strong>Date:</strong> 2025-08-16</p>
                    <p class="card-text mb-1"><strong>City:</strong> Beach City</p>
                    <p class="card-text mb-2"><strong>Booking ID:</strong> 2</p>
                    <span class="badge bg-warning text-dark mb-3">Pending</span>
                    <a href="#" class="btn btn-primary float-end">View</a>
                </div>
            </div>
        </div>

        <!-- Booking Card 3 -->
        <div class="col-md-6 col-lg-4 booking-card" data-status="Cancelled" data-city="Mountain Town" data-date="2025-08-20">
            <div class="card shadow-sm">
                <img src="https://via.placeholder.com/400x250" class="card-img-top" alt="Mountain Cabin">
                <div class="card-body">
                    <h5 class="card-title">Mountain Cabin</h5>
                    <p class="card-text mb-1"><strong>Date:</strong> 2025-08-20</p>
                    <p class="card-text mb-1"><strong>City:</strong> Mountain Town</p>
                    <p class="card-text mb-2"><strong>Booking ID:</strong> 3</p>
                    <span class="badge bg-danger mb-3">Cancelled</span>
                    <a href="#" class="btn btn-primary float-end">View</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const statusFilter = document.getElementById('statusFilter');
    const cityFilter = document.getElementById('cityFilter');
    const dateFilter = document.getElementById('dateFilter');
    const resetBtn = document.getElementById('resetFilters');
    const cards = document.querySelectorAll('.booking-card');

    function filterCards() {
        const status = statusFilter.value;
        const city = cityFilter.value;
        const date = dateFilter.value;

        cards.forEach(card => {
            const matchStatus = (status === 'all' || card.dataset.status === status);
            const matchCity = (city === 'all' || card.dataset.city === city);
            const matchDate = (!date || card.dataset.date === date);

            card.style.display = (matchStatus && matchCity && matchDate) ? 'block' : 'none';
        });
    }

    statusFilter.addEventListener('change', filterCards);
    cityFilter.addEventListener('change', filterCards);
    dateFilter.addEventListener('change', filterCards);

    resetBtn.addEventListener('click', () => {
        statusFilter.value = 'all';
        cityFilter.value = 'all';
        dateFilter.value = '';
        filterCards();
    });
</script>
@endsection
