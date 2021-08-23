<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function show($slug)
    {
        $tag = Tag::where('slug', $slug)->Firstorfail();
        $posts = $tag->posts()->orderBy('id', 'desc')->simplePaginate(2);
        $categories = Category::all();
        return view('tags.show', compact('tag', 'posts', 'categories'));
    }
}
