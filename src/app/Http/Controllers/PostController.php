<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditPostRequest;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->get();

        return view('posts/index', ['posts' => $posts]);
    }

    public function store()
    {
        return view('posts/post');
    }

    public function storeComplete(StorePostRequest $request)
    {
        $postData = [
            'body' => $request->input('body.0'),
            'user_id' => Auth::id(),
        ];

        // 投稿作品のファイルがある場合は投稿のデータの連想配列に保存
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $postData['image'] = $request->file('image')->store('public/images');
        }

        Post::create($postData);

        return redirect()->route('post')->with('success', '投稿完了しました');
    }

    public function edit(int $postId)
    {
        $post = Post::where('id', $postId)->get()->all()[0];
        session()->flash('image', $post['image']);

        return view('posts/edit', ['post' => $post]);
    }

    public function editComplete(EditPostRequest $request, int $postId)
    {
        // 投稿内容を更新するために連想配列をセット
        $postDate = [
            'body' => $request->input('body.0')
        ];

        if ($request->hasFile('image')) {
            // 投稿画像のアップロードに問題がある場合は編集画面にリダイレクト
            if ($request->file('image')->isValid()) {
                redirect()->route('post.edit', ['postId' => $postId]);
            }

            // 編集前の投稿画像がある場合は削除する
            if (!is_null(session('image'))) {
                Storage::delete(session('image'));
            }

            // 投稿内容更新用の連想配列に投稿画像のパスを追加
            $postDate['image'] = $request->file('image')->store('public');
        }

        Post::where('id', $postId)
            ->update($postDate);

        return redirect()->route('post');
    }
}
