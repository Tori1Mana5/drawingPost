<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRegistRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function regist()
    {
        return view('user/regist');
    }

    public function complete(UserRegistRequest $request)
    {
        $body = $request->input('body');

        User::create([
            'username' => $body[0],
            'display_name' => $body[1],
            'email' => $body[2],
            'password' => Hash::make($body[3])
        ]);

        return view('user/complete');
    }
}
