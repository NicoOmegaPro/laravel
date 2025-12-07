<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{ 
    use HasFactory; 
    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
}
