<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Island;
use App\Models\Zone;

class Municipality extends Model
{
    public function island()
    {
        return $this->belongsTo(Island::class);
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }
}
