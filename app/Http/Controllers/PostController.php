<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use \Cviebrock\EloquentSluggable\Services\SlugService;

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
            'slug' => ['required', 'unique:posts'],
            'content' => ['required'],
            'categories' => ['required'],
            'tags' => ['required'],
            'image' => ['required', 'image', 'max:2048']
        ]);

        // Menginput image user
        $filename = $request->image->getClientOriginalName();
        $request->image->storeAs('posts', $filename);
        $data = [
            'title' => $request->title,
            'image' => $filename,
            'content' => $request->content,
            'is_pinned' => 0,
            'created_by' => auth()->user()->name
        ];

        $post = Post::create($data);
        $post->category()->attach($request->categories);
        $post->tag()->attach($request->tags);
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
            ->addColumn('is_pinned', function ($post) {
                return $post->is_pinned == 1 ? '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pin-angle-fill" viewBox="0 0 16 16">
                    <path d="M9.828.722a.5.5 0 0 1 .354.146l4.95 4.95a.5.5 0 0 1 0 .707c-.48.48-1.072.588-1.503.588-.177 0-.335-.018-.46-.039l-3.134 3.134a5.927 5.927 0 0 1 .16 1.013c.046.702-.032 1.687-.72 2.375a.5.5 0 0 1-.707 0l-2.829-2.828-3.182 3.182c-.195.195-1.219.902-1.414.707-.195-.195.512-1.22.707-1.414l3.182-3.182-2.828-2.829a.5.5 0 0 1 0-.707c.688-.688 1.673-.767 2.375-.72a5.922 5.922 0 0 1 1.013.16l3.134-3.133a2.772 2.772 0 0 1-.04-.461c0-.43.108-1.022.589-1.503a.5.5 0 0 1 .353-.146z"/>
                </svg>' : '';
            })
            ->addColumn('views', function ($post) {
                return '' . $post->views . '<i class="fa fa-eye ms-2"></i>';
            })
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

        return response()->json(['success' => 'Post has been Deleted!']);
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
            'slug' => [],
            'categories' => ['required'],
            'tags' => ['required'],
            'content' => ['required'],
            'image' => ['image', 'max:2048']
        ]);

        $data = [
            'title' => $request->title,
            'slug' => $request->slug,
            'is_pinned' => $request->is_pinned,
            'content' => $request->content,
            'created_by' => auth()->user()->name
        ];
        //Mengecek apakah user upload image
        if ($request->hasFile('image')) {
            // Menginput image user
            $filename = $request->image->getClientOriginalName();
            $request->image->storeAs('posts', $filename);
            $data = ['image' => $filename];
        }
        //Menyimpan data update post
        $post->category()->sync($request->categories);
        $post->tag()->sync($request->tags);
        $post->update($data);

        //mengembalikan ke halaman ketika user berhasil update
        return redirect('/post/list')->with('success', 'User updated successfully');
    }
    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
