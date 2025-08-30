<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Property;
use App\Models\Booking;
use App\Models\Payment;

class DashboardController extends Controller
{
    public function index()
    {
        $usersCount = User::count();
        $propertiesCount = Property::count();
        $bookingsCount = Booking::count();
        $totalRevenue = Payment::sum('amount'); 

        return view('admin.dashboard.index', compact('usersCount', 'propertiesCount', 'bookingsCount', 'totalRevenue'));
    }
}
