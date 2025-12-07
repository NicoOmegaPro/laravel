<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PlaceType;
use App\Models\Image;

class InterestingPlace extends Model
{
    public function place_type()
    {
        return $this->belongsTo(PlaceType::class);
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
