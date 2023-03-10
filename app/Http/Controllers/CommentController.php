<?php

namespace App\Http\Controllers;

use App\Models\Post;
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

    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'content' => ['required']
        ]);
        $data = [
            "post_id" => $request->post_id,
            "user_id" => auth()->id(),
            "content" => $request->content,
        ];
        $findComment = Comment::find($comment->id);
        $findComment->update($data);

        return redirect()->back()->with('success', 'Comment Created Successfully!');
    }
    public function reply(Request $request, Comment $comment)
    {
        // Mendapatkan data komentar dan validasi form
        $comment = Comment::findOrFail($request->input('comment_id'));

        $request->validate([
            'content' => ['required'],
        ]);
        // Menyimpan balasan komentar ke dalam database
        $reply = new Comment;
        $reply->post_id = $request->input('post_id');
        $reply->content = $request->input('content');
        $reply->user_id = auth()->user()->id;
        $comment->replies()->save($reply);

        // Redirect kembali ke halaman komentar
        return redirect()->back();
    }
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->back();
    }
}
