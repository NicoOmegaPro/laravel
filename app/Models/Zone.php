<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    public function Municipalities()
    {
        return $this->hasMany(Municipality::class);
    }
}
