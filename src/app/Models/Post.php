<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function get()
    {
        return self::query()
        ->join('users', 'posts.user_id', '=', 'users.id')
        ->get();
    }

}
