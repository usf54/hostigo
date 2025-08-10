<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    public function properties()
    {
        return $this->belongsToMany(Property::class, 'amenity_property');
    }
}
