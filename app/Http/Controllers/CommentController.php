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

    public function storeReply(Request $request,  $post,  $comment)
    {
        Comment::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post,
            'parent_id' => $comment,
            'comments' => $request->comment_body,
        ]);
        return redirect(route('blogs.show', $post));
    }

    public function approveComment(Comment $comment)
    {
        $comment->update(['approved_at' => now()]);
        $comment->update(['reason' => NULL]);
        session()->flash('success', ' Comment has been approved by the admin!');
        return redirect(route('posts.allComments'));
    }

    public function disapproveComment(Request $request, Comment $comment)
    {
        $comment->update(['approved_at' => NULL]);
        $comment->update(['reason' =>  $request->exampleRadios]);
        session()->flash('error', " Comment has been disapproved by the admin because of $request->exampleRadios");
        return redirect(route('posts.allComments'));
    }

    public function reason(Comment $comment)
    {
        $comment = Comment::findOrFail($comment->id);
        return view('posts.comment-reason',compact('comment'));
    }
}
