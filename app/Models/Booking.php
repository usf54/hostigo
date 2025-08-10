<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Payment;
use App\Models\Property;
use App\Models\Review;

class Booking extends Model
{
    protected $fillable = [
        'user_id', 'property_id', 'check_in', 'check_out', 'total_price', 'status'
    ];

    public function guest()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }
}
