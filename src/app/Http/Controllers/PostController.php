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
        $posts = Post::with('user')->get();
        return view('posts/index', ['posts' => $posts]);
    }

    public function create()
    {
        return view('posts/post');
    }

    public function store(PostStoreRequest $request)
    {
        Post::create([
            'body' => $request->input('body'),
            'user_id' => 1,
        ]);

        return redirect()->route('post');
    }
}
