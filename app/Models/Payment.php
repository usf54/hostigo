<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Booking;

class Payment extends Model
{
    protected $fillable = [
        'booking_id', 
        'amount', 
        'payment_method', 
        'status', 
        'transaction_id',
        'stripe_payment_intent_id', 
        'stripe_client_secret', 
        'currency', 
        'metadata' 
    ];
    
    protected $casts = [
        'metadata' => 'array',
        'amount' => 'decimal:2'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    // helper methods
    public function isPaid()
    {
        return $this->status === 'completed';
    }

    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isFailed()
    {
        return $this->status === 'failed';
    }
}