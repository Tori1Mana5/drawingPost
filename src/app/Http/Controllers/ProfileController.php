<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Profile;
use App\Http\Requests\ProfileRequest;

use App\Models\User;

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

        return view('profile/show', ['posts' => $posts, 'profiles' => $profiles, 'user_name' => $user_name]);
    }

    public function edit(string $user_name)
    {
        return view('profile/edit', ['user_name' => $user_name]);
    }

    public function complete(string $user_name, ProfileRequest $request)
    {
        $body = $request->input('body.0');
        // プロフィールを紐付けるためにUserからidを取得
        $user_id = User::where('username', $user_name)->value('id');

        $profile_icon = null;
        $profile_background = null;

        if($request->hasFile('profile_image') && $request->file('profile_image')->isValid()) {
            $profile_icon = $request->file('profile_image.0')->store('public/profile');
            $profile_background = $request->file('profile_image.1')->store('public/profile');
        }

        Profile::create([
            'profile' => $body,
            'profile_icon' => $profile_icon,
            'profile_background' => $profile_background,
            'user_id' => $user_id
        ]);

        return redirect()->route('profile.edit', ['user_name' => $user_name]);
    }
}
