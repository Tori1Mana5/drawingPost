<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Profile;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
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
