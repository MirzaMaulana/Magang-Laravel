<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function index()
    {
        return view('welcome', [
            "posts" => Post::latest()->paginate(7)->withQueryString()
        ]);
    }
    public function show(Post $post)
    {
        return view('index.post', [
            'post' => $post
        ]);
    }
}
