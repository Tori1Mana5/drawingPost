<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register()
    {
        return view('user/register');
    }

    public function complete(RegisterUserRequest $request)
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
