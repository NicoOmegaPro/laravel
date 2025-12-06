<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Place_type;
use App\Models\Image;

class Interesting_place extends Model
{
    public function place_type()
    {
        return $this->belongsTo(Place_type::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function treks()
    {
        return $this->belongsToMany(Trek::class);
    }
}
