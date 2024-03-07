<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = ['username', 'display_name', 'email', 'password'];

    use HasFactory;
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

    public function userToken()
    {
        return $this->hasOne(UserToken::class);
    }
}
