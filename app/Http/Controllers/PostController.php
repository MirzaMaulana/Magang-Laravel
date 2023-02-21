<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function create()
    {
        return view('post.create', [
            "categories" => Category::all(),
            "tags" => Tags::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required'],
            'image' => ['required', 'image', 'max:2048']
        ]);

        // Menginput image user
        $filename = $request->image->getClientOriginalName();
        $request->image->storeAs('posts', $filename);
        $data = [
            'title' => $request->title,
            'image' => $filename,
            'content' => $request->content,
            'created_by' => auth()->user()->name
        ];

        $post = Post::create($data);
        $post->category()->attach($request->category);
        $post->tag()->attach($request->tag);
        return redirect('/post/list')->with('success', 'Success Create Post');
    }

    public function list(Request $request)
    {
        return datatables()
            ->eloquent(Post::query()->when(!$request->order, function ($query) {
                $query->latest();
            }))

            ->addColumn('action', function ($post) {
                return '
                <div class="d-flex">
                <form onsubmit="destroy(event)" action="' .  route('post.destroy', $post->id) . '" method="POST">
                <input type="hidden" name="_token" value="' . @csrf_token() . '">
                <input type="hidden" name="_method" value="DELETE">
                <button class="btn-danger btn btn-sm  mr-2">
                <i class="fa fa-trash"></i>
                </button>
                </td>
                </form>
                 <a href="' . route('post.edit', $post->id) . '" class="btn btn-sm btn-primary rounded"><i class="fa fa-pen"></i></a>
                 </div>  
            ';
            })
            // ->addColumn('image', function ($post) {
            //     return '<img src="/storage/posts/' . $post->image . '" class="img-fluid" alt="img-post" widht="50">';
            // })
            ->addIndexColumn()
            ->escapeColumns(['action'])
            ->toJson();
    }

    //view list postingan
    public function index()
    {
        return view('post.list');
    }

    // delete post
    public function destroy(Post $post)
    {
        $path = public_path('storage/posts/' . $post->image);
        if (File::exists($path)) {
            File::delete($path);
        }
        // hapus entri di tabel pivot untuk kategori dan tag
        $post->category()->detach();
        $post->tag()->detach();
        $post->delete();

        return redirect()->back();
    }

    //view edit post
    public function edit($id)
    {
        $post = Post::find($id);
        return view('post.edit', [
            "categories" => Category::all(),
            "tags" => Tags::all()
        ], compact('post'));
    }

    // Update post
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required'],
            'image' => ['required', 'image', 'max:2048']
        ]);

        // Menginput image user
        $filename = $request->image->getClientOriginalName();
        $request->image->storeAs('posts', $filename);
        $data = [
            'title' => $request->title,
            'image' => $filename,
            'content' => $request->content,
            'created_by' => auth()->user()->name
        ];


        //Menyimpan data update post
        $post->update($data);
        $post->category()->sync($request->category);
        $post->tag()->sync($request->tag);
        //mengembalikan ke halaman ketika user berhasil update
        return redirect('/post/list')->with('success', 'User updated successfully');
    }
}
