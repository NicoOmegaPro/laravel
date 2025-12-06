<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trek extends Model
{
    public function Meetings()
    {
        return $this->hasMany(Meeting::class);
    }

    public function Municipality()
    {
        return $this->belongsTo(Municipality::class);
    }

    public function Interesting_places()
    {
        return $this->belongsToMany(Interesting_place::class);
    }
}
