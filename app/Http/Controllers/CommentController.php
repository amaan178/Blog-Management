<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        auth()->user()->comments()->create([
            'comments' => $request->comment_body,
            'post_id' => $post->id
        ]);
        return redirect(route('blogs.show', $post->id));
    }

    public function comment()
    {
        $comment = Comment::paginate(10);
        return view('posts.comment', ['comments' => $comment]);
    }

    public function approveComment(Comment $comment)
    {
        $comment->update(['approved_at' => now()]);
        session()->flash('success', ' Comment has been approved by the admin!');
        return redirect(route('posts.allComments'));
    }

    public function disapproveComment(Comment $comment)
    {
        $comment->update(['approved_at' => NULL]);
        session()->flash('error', ' Comment has been disapproved by the admin!');
        return redirect(route('posts.allComments'));
    }
}
