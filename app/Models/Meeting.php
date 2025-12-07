<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Trek;

class Meeting extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trek()
    {
        return $this->belongsTo(Trek::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
