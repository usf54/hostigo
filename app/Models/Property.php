<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\PropertyImage;
use App\Models\Booking;
use App\Models\User;
use App\Models\Amenity;

class Property extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'user_id', 
        'title', 
        'description', 
        'price_per_night',
        'address', 
        'city', 
        'country', 
        'latitude', 
        'longitude', 
        'max_guests'
    ];

    public function host()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function amenities()
    {
        return $this->belongsToMany(Amenity::class, 'amenity_property');
    }

    public function images()
    {
        return $this->hasMany(PropertyImage::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
