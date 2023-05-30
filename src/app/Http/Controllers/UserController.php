<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRegistRequest;
use App\Models\User;
use App\Models\Post;
use App\Models\Profile;
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

    public function show(string $user_name)
    {
        $posts = Post::withWhereHas('user', function ($query) use ($user_name) {
            $query->where('username', $user_name);
        })->get();

        $profiles = Profile::withWhereHas('user', function ($query) use ($user_name) {
            $query->where('username', $user_name);
        })->get();

        if ($posts->isEmpty()) {
            return redirect()->route('post');
        }

        return view('user/profile', ['posts' => $posts, 'profiles' => $profiles, 'user_name' => $user_name]);
    }
}
