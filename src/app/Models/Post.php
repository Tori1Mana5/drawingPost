<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    protected $fillable = [
        'body', 
        'image', 
        'user_id', 
        'deleted_at',
    ];

    use HasFactory;

    // ソフトデリートを利用
    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
