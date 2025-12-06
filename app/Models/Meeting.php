<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Trek;

class Meeting extends Model
{
    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Trek()
    {
        return $this->belongsTo(Trek::class);
    }

    public function Users()
    {
        return $this->belongsToMany(User::class);
    }
}
