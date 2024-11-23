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

    /**
     * パスワードを再設定したユーザーを取得
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
