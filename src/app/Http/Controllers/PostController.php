<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostStoreRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->get();

        return view('posts/index', ['posts' => $posts]);
    }

    public function create()
    {
        return view('posts/post');
    }

    public function complete(PostStoreRequest $request)
    {
        $text = $request->input('body.0');
        $image_path = null;
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image_path = $request->file('image')->store('public/images');
        }

        Post::create([
            'body' => $text,
            'image' => $image_path,
            'user_id' => 1,
        ]);

        return redirect()->route('post')->with('success', '投稿完了しました');
    }

}
