<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function get()
    {
        return view('home');
    }

    public function post(Request $request)
    {
        $text = $request->input('text');
        $file = $request->file('file');

        if (is_null($text) && is_null($file)) {
            var_dump('画像または入力してください');exit();
        }

        $postModel = new Post();

        // if there is no file, save text only.
        if(is_null($file)) {
            var_dump('テキストだけ登録');
            $postModel->post([
                'user_id' => 1111,  // TODO
                'text' => $text,
            ]);
            exit();
        }

        $filepath = $file->store('public');

        // save submitted works and content
        $postModel->post([
            ''
        ]);

        return view('home')->with([
            'text' => $text,
        ]);
    }
}
