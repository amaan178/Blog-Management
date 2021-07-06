<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        // $search = request('search');
        // if(! $search) {
        //     $posts = Post::latest('published_at')->published()->simplePaginate(4);
        // } else {
        //     $posts = Post::where('title', 'like', '%$search%')
        // }

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
        $tags = Tag::all();
        $categories = Category::all();
        return view('blogs.post', compact(['post', 'tags', 'categories']));
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
