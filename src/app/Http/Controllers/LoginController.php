<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function authenticate(LoginRequest $request)
    {
        if (Auth::attempt(['email' => $request->body[0], 'password' => $request->body[1]], true)) {
            $request->session()->regenerate();
            return redirect()->route('post');
        }
        return back()->withErrors([
            'body.0' => 'メールアドレスかパスワードに誤りがあります'
        ])->onlyInput('body.0');
    }
}
