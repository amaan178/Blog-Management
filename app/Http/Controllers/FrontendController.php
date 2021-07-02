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
            ->published()
            ->simplePaginate(2);
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
}
