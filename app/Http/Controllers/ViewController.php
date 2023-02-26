<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tags;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function index(Request $request)
    {
        $categoryName = null;
        $tagName = null;
        if (request('category')) {
            $category = Category::firstWhere('name', request('category'));
            if ($category) {
                $categoryName = $category->name;
            }
        }
        if (request('tag')) {
            $tag = Tags::firstWhere('name', request('tag'));
            if ($tag) {
                $tagName = $tag->name;
            }
        }
        return view('welcome', [
            "categoryName" => $categoryName,
            "tagName" => $tagName,
            "pinnedPost" => Post::latest()->where('is_pinned', true)->get(),
            "posts" => Post::latest()->filter(request(['tag', 'category']))->paginate(6)->withQueryString()
        ]);
    }

    public function show(Post $post)
    {
        return view('index.post', [
            'post' => $post
        ]);
    }
}
