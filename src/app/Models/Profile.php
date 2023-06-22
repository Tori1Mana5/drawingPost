<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['profile', 'profile_icon', 'profile_background', 'user_id'];

    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
