<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['username', 'display_name', 'email', 'password'];

    use HasFactory;
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
