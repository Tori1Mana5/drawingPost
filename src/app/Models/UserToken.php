<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserToken extends Model
{
    use HasFactory;

    // ソフトデリートを利用
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'token',
        'expire_at',
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
