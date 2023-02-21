<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function get()
    {
        $postModel = new Post();
        return view('home', ['posts' => $postModel->get()]);
    }
}
