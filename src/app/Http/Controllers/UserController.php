<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register()
    {
        return view('user/register');
    }

    public function complete(RegisterUserRequest $request)
    {
        User::create([
            'username' => $request->input('userName'),
            'display_name' => $request->input('displayName'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'),)
        ]);

        return view('user/complete');
    }
}
