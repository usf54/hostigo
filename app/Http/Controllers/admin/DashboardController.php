<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use Inertia\Inertia;
use Carbon\Carbon;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(Request $request) {
        $latestUsers = User::latest()->take(10)->get();
        $totalRevenue = Payment::where('status', 'completed')->sum('amount');
        $totalPaymentThisWeek = Payment::whereBetween('created_at',[
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ])->count();
        
        $usersThisMonth = User::whereBetween('created_at', [
            Carbon::now()->startOfMonth(),
            Carbon::now()->endOfMonth()
        ])->get()->groupBy('role');

        $totalAdminsThisMonth = $usersThisMonth->get('admin') ? $usersThisMonth->get('admin')->count() : 0;
        $totalHostsThisMonth = $usersThisMonth->get('host') ? $usersThisMonth->get('host')->count() : 0;
        $totalGuestsThisMonth = $usersThisMonth->get('guest') ? $usersThisMonth->get('guest')->count() : 0;
        $totalCustomersThisMonth = $usersThisMonth->flatten()->count();

        // Get the authenticated user with explicit role property
        $authUser = $request->user();
        
        // dd($authUser);
        return Inertia::render('Dashboard', [
                'latestUsers' => $latestUsers,
                'totalRevenue' => number_format($totalRevenue, 2, '.', ''),
                'totalPaymentThisWeek' => $totalPaymentThisWeek,
                'totalAdminsThisMonth' => $totalAdminsThisMonth,
                'totalCustomersThisMonth' => $totalCustomersThisMonth,
                'totalHostsThisMonth' => $totalHostsThisMonth,
                'totalGuestsThisMonth' => $totalGuestsThisMonth,
                'auth' => [
                    'user' => [
                        'id' => $authUser->id,
                        'name' => $authUser->name,
                        'email' => $authUser->email,
                        'role' => $authUser->role,
                        'avatar' => $authUser->image,
                    ]
                ],
        ]);
    }
}