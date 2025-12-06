<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Place_type extends Model
{
    public function Interestings_places()
    {
        return $this->hasMany(Interesting_place::class);
    }
}
