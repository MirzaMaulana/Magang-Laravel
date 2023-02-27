<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        return view('index.post', [
            'comment' => Comment::all()
        ]);
    }

    // create comment
    public function create(Request $request)
    {
        $request->validate([
            'content' => ['required']
        ]);
        $data = [
            "post_id" => $request->post_id,
            "user_id" => auth()->id(),
            "content" => $request->content,
        ];
        $comment = Comment::create($data);
        return redirect()->back()->with('success', 'Comment Created Successfully!');
    }

    public function update(Request $request)
    {
        $request->validate([
            'content' => ['required']
        ]);
        $data = [
            "post_id" => $request->post_id,
            "user_id" => auth()->id(),
            "content" => $request->content,
        ];
        $comment = Comment::create($data);
        return redirect()->back()->with('success', 'Comment Created Successfully!');
    }
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->back();
    }
}
