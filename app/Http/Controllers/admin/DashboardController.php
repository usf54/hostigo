<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use Inertia\Inertia;
use Carbon\Carbon;


class DashboardController extends Controller
{
    public function index() {
        $totalRevenue = Payment::where('status', 'completed')->sum('amount');
        $totalPaymentThisWeek = Payment::whereBetween('created_at',[
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ])->count();
        
        return Inertia::render('Dashboard', [
                'totalRevenue' => number_format($totalRevenue, 2, '.', ''),
                'totalPaymentThisWeek' => $totalPaymentThisWeek,
        ]);
        
    }
}
