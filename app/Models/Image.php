<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;

class Image extends Model
{
    public function Comment()
    {
        return $this->belongsTo(Comment::class);
    }
}
