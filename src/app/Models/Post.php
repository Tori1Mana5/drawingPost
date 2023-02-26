<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
<<<<<<< HEAD
    use HasFactory;
=======
    public function user()
    {
        return $this->belongsTo(User::class);
    }
>>>>>>> feature/#4
}
