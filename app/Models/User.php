<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Property;
use App\Models\Booking;
use App\Models\Review;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    
    public function isHost()
    {
        return $this->role === 'host'; // or whatever logic you use to determine hosts
    }
    
    public function isAdmin()
    {
        return $this->role === 'admin';
    }
    
    public function isGuest()
    {
        return $this->role === 'guest';
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    // A host can have many properties
    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    // A guest can have many bookings
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    // A user can leave many reviews
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
