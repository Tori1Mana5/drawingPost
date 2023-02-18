<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function get()
    {
        return view('user_register');
    }

    public function register(Request $request)
    {

        // パスワードをソルトつけてハッシュ化
        // 保存する値を設定
    }

}
