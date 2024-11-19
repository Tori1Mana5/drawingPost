<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditPostRequest;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->get()
        ->sortBy([
            ['created_at', 'desc']
        ]);

        return view('posts/index', ['posts' => $posts]);
    }

    public function show (int $postId)
    {
        $posts = Post::with('user')
        ->where('id', $postId)
        ->first();
        
        return view('posts/show', ['posts' => $posts]);
    }

    public function store()
    {
        return view('posts/post');
    }

    public function storeComplete(StorePostRequest $request)
    {
        $postData = [
            'body' => $request->input('text'),
            'user_id' => Auth::id(),
        ];

        // 投稿作品のファイルがある場合は投稿のデータの連想配列に保存
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $manager = new ImageManager();
            $image = $manager->make($request->file('image'));

            // ファイルサイズを縮小する
            $resizedImage = $image->heighten(200);

            // ランダムな文字列を設定して保存するファイル名を設定
            $fileName = $request->file('image')->hashName();

            // 保存先パスとその保存ファイル名の設定
            $filePath = storage_path('app/public/images/' . $fileName);

            // ファイル保存
            $resizedImage->save($filePath);

            // DB保存のためにファイルパスを設定
            $postData['image'] = 'public/images/' . $fileName;
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
            'body' => $request->input('text')
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
