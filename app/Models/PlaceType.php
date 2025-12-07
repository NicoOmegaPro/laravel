<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlaceType extends Model
{
    public function interesting_places()
    {
        return $this->hasMany(InterestingPlace::class);
    }
}
