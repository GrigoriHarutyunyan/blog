<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
   public function index()
   {
       $posts = Post::with('category')->orderBy('id','desc')->simplePaginate(2);
       $categories = Category::all();
       return view('posts.index', compact('posts', 'categories'));
   }

   public function show($slug)
   {
       $post = Post::where('slug', $slug)->firstOrFail();
//       $categories = Category::all();
       $post->views +=1;
       $post->update();
        return view('posts.show', compact('post'));
   }
}
