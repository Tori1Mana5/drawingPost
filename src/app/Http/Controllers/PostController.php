<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostStoreRequest;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->get()->toArray();

        dd($posts);exit();

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
            'body' => $body,
            'user_id' => 1,
        ]);

        return redirect()->route('post')->with('success', '投稿完了しました');
    }

    public function confirm(PostStoreRequest $request)
    {
        $request->flash();
        return view('posts.confirm');
    }
}
