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

    public function complete()
    {
        $body = old('body');

        if (is_null($body)) {
            return redirect()->route('post.create');
        }

        Post::create([
            'body' => $body[0],
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('post')->with('success', '投稿完了しました');
    }

    public function confirm(PostStoreRequest $request)
    {
        $request->flash();
        return view('posts.confirm');
    }
}
