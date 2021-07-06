<?php

namespace App\Http\Controllers;

use App\Http\Requests\post\CreatePostRequest as PostCreatePostRequest;
use App\Http\Requests\post\UpdatePostRequest as PostUpdatePostRequest;
use App\Http\Requests\Posts\CreatePostRequest;
use App\Http\Requests\Posts\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware(['validateAuthor'])->only('edit', 'update', 'destroy', 'trash');
        $this->middleware(['verifyCategory', 'verifyTag'])->only('create', 'store');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->isAdmin()) {
            $posts = Post::publishedAndApproved()->paginate(3);
        } else {
            $posts = Post::published()->where('user_id', auth()->id())->paginate(10); //to do: using scope
        }

        return view('posts.index', compact(['posts']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create', compact(['categories', 'tags']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCreatePostRequest $request)
    {
        $image = $request->file('image')->store('images/posts');
        $post = Post::create([
            'title' => $request->title,
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'user_id' => auth()->id(),
            'image' => $image,
            'published_at' => $request->published_at,

        ]);

        $post->tags()->attach($request->tags);
        session()->flash('success', 'A request to approve your post has been sent to the admin');
        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {

        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.edit', compact(['post', 'categories', 'tags']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdatePostRequest $request, Post $post)
    {
        $data = $request->only('title', 'excerpt', 'content', 'published_at', 'category_id');

        if ($request->hasFile('image')) {
            $image = $request->image->store('images/posts');
            $data['image'] = $image;
            $post->deleteImage();
        }

        $post->update($data);

        $post->tags()->sync($request->tags);
        session()->flash('success', 'Post update successfully');
        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) //we are not using Post $post here because route-model binding fails
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        $post->deleteImage();
        $post->forceDelete();
        session()->flash('success', 'Post deleted successfully!');
        return redirect(route('posts.trashed'));
    }

    public function trash(Post $post)
    {
        $post->delete();
        session()->flash('success', 'Post trashed');
        return redirect(route('posts.index'));
    }

    public function trashed()
    {
        $trashed = Post::onlyTrashed()->paginate(10);
        return view('posts.trashed', ['posts' => $trashed]);
    }

    public function restore($id)
    {
        $trashedPost = Post::onlyTrashed()->findOrFail($id);
        $trashedPost->restore();
        session()->flash('success', 'Post restored succesfully!');
        return redirect(route('posts.index'));
    }

    public function drafts()
    {
        $drafts = Post::drafted()->paginate(3);
        return view('posts.drafts', ['posts' => $drafts]);
    }
    public function draftPost(Post $post)
    {
        $post->update(['published_at' => NULL]);
        session()->flash('success', 'Post drafted successfully!');
        return redirect(route('posts.index'));
    }
    public function publishDraft(Post $post)
    {

        $post->update(['published_at' => now()]);
        session()->flash('success', 'Post published successfully!');
        return redirect(route('posts.index'));
    }

    public function requests()
    {
        $posts = Post::requested()->paginate(3);
        return view('posts.requests', compact('posts'));
    }

    public function approveRequest(Post $post)
    {
        $post->update(['approval' => now()]);
        $post->update(['reason' => NULL]);
        session()->flash('success', 'Post approved!');
        return redirect(route('posts.index'));
    }
    public function disapproveRequest(Request $request, Post $post)
    {
        $post->update(['reason' => $request->exampleRadios]);
        $post->update(['approval' => NULL]);
        session()->flash('error', "Post has been disapproved! reason: $request->exampleRadios");
        return redirect(route('posts.approval-requests'));
    }

    public function disapproveReason(Post $post)
    {
        $post = Post::findOrFail($post->id);
        return view('posts.reasons',compact('post'));
    }
}
