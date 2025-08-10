<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Property;

class PropertyImage extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'property_id', 'image_url'
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
