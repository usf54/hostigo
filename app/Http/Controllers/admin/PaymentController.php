<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with(['booking.guest', 'booking.property'])->get();

        return Inertia::render('Admin/Payments/Index', 
        ['payments' => $payments]);
    }

    public function show($id)
    {
        $payment = Payment::with(['booking.guest', 'booking.property'])->findOrFail($id);

        return Inertia::render('Admin/Payments/Show', [
            'payment' => $payment
        ]);
    }
    
    public function actionDenied()
    {
        return Inertia::render('Admin/Payments/ActionDenied');
    }
}
