<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trek extends Model
{
    public function meetings()
    {
        return $this->hasMany(Meeting::class);
    }

    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }

    public function interesting_places()
    {
        return $this->belongsToMany(InterestingPlace::class)->withTimestamps()->withPivot('order');
    }
}