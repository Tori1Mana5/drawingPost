<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function regist()
    {
        return view('user/regist');
    }

    public function confirm()
    {
        return view('user/confirm');
    }

    public function complete()
    {
        return view('user/complete');
    }
}
