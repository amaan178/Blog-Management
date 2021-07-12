<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $posts = Post::search()
            ->latest('published_at')
            ->publishedAndApproved()
            ->simplePaginate(3);
        $tags = Tag::all();
        $categories = Category::all();
        return view('blogs.index', compact(['posts', 'tags', 'categories']));
    }

    public function show(Post $post)
    {
        $post->increment('views_count');
        $tags = Tag::all();
        $categories = Category::all();
        $comments = Comment::approved()->with('user')->get();
        return view('blogs.post', compact(['post', 'tags', 'categories', 'comments']));
    }

    public function category(Category $category)
    {
        $posts = $category->posts()
            ->search()
            ->published()
            ->latest('published_at')
            ->simplePaginate(10);
        $tags = Tag::all();
        $categories = Category::all();
        return view('blogs.index', compact(['posts', 'tags', 'categories']));
    }

    public function tag(Tag $tag)
    {
        $posts = $tag->posts()
            ->search()
            ->published()
            ->latest('published_at')
            ->simplePaginate(10);
        $tags = Tag::all();
        $categories = Category::all();
        return view('blogs.index', compact(['posts', 'tags', 'categories']));
    }
}
