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

    /**
     * 入力されたログイン情報を認証する
     *
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function authenticate(LoginRequest $request)
    {
        // リクエストで入力されたメールアドレスとパスワードで認証を実行し、認証できなかった場合は入力画面に戻す
        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')], true)) {
            $request->session()->regenerate();
            return redirect()->route('post');
        }
        return back()->with('flash_message', 'メールアドレスかパスワードに誤りがあります')->onlyInput('email');
    }
}
