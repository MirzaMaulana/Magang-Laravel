<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tags;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ViewController extends Controller
{
    public function index(Request $request)
    {
        // Mendapatkan nama category atau tag
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
    public function edit()
    {
        return view('my-profile.profile');
    }
    public function update(Request $request, User $user)
    {
        // input data
        $data = [
            'name' => $request->name,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
        ];
        //Mengecek apakah user upload image
        if ($request->hasFile('image')) {
            // Menginput image user
            $filename = $request->image->getClientOriginalName();
            $request->image->storeAs('avatars', $filename);
            $data = ['image' => $filename];
        }
        //Menyimpan data update user
        $users = Auth::user();
        $findUser = User::find($users->id);
        $findUser->update($data);
        //mengembalikan ke halaman ketika user berhasil update
        return redirect()->route('welcome')->with('success', 'updated profile successfully');
    }
    public function show(Request $request, Post $post)
    {
        if ($post->slug == $request->route('post.show', $post->slug)) {
            $post->views++;
            $post->save();
        }

        return view('index.post', [
            'post' => $post,
            "posts" => Post::inRandomOrder()->limit(4)->get()
        ]);
    }
}
