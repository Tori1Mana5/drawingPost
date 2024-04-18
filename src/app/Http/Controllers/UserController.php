<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
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

    /**
     * 削除実行の確認画面を表示する
     *
     * @return view
     */
    public function deleteConfirm() {
        return view('user/delete');
    }
    
    /**
     * 削除処置を実行する
     */
    public function deleteComplete(Request $request) {
        // 削除対象のユーザーを取得
        $user = User::where('id', $request->input('userId'))->first();

        //　対象のユーザーを削除する
        $user->delete();

        redirect()->route('post');
    }
}
