<?php

namespace App\Http\Controllers;

use App\Models\PostSave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostSaveController extends Controller
{
    public function index()
    {
        $savedPosts = PostSave::where('user_id', auth()->id())->get();
        return view('index.saves', compact('savedPosts'));
    }
    public function postsave(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        $savepost = new PostSave;
        $savepost->user_id = auth()->id();
        $savepost->post_id = $request->post_id;
        $savepost->save();

        return back();
    }
    public function destroy($id)
    {
        $postSave = PostSave::where('post_id', $id);
        $postSave->delete();

        return redirect()->back();
    }
}
