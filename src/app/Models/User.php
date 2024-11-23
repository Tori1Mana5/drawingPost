<?php

namespace App\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'username', 
        'display_name', 
        'email', 
        'password',
        'deleted_at',
    ];

    use HasFactory;

    // ソフトデリートを利用
    use SoftDeletes;

    // リレーション関係があっても消せるようにlaravel-soft-cascadeを利用
    use SoftCascadeTrait;

    // 対象のリレーション
    protected $softCascade = [
        'posts', 
        'profile',
        'userToken',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * ユーザーに関連するプロフィールの取得
     *
     * @return void
     */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    /**
     * パスワード再設定時の有効なトークン情報の取得
     *
     * @return void
     */
    public function userToken()
    {
        return $this->hasOne(UserToken::class);
    }
}
