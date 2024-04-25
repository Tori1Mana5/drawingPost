<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    protected $fillable = [
        'profile', 
        'profile_icon', 
        'profile_background', 
        'user_id',
        'deleted_at'
    ];

    use HasFactory;

    // ソフトデリートを利用
    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
