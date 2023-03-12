<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\postLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostLikeController extends Controller
{
    public function store(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        $like = new postLike;
        $like->user_id = auth()->id();
        $like->post_id = $request->post_id;
        $like->save();

        return back();
    }
    public function destroy($id)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        // mengambil id user yang sedang login
        $userId = Auth::id();
        $like = postLike::where('id', $id)->where('user_id', $userId)->first();
        if ($like) {
            $like->delete();
        }

        return redirect()->back();
    }
}
