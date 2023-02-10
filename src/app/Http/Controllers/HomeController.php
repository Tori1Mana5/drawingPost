<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function get()
    {
        return view('home');
    }

    public function post(Request $request)
    {
        $text = $request->input('text');
        $filepath = $request->input('file');

        return view('home')->with([
            "text" => $text,
        ]);
    }
}
