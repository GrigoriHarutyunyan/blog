<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use function GuzzleHttp\Promise\all;

class PostController extends Controller
{
   public function index()
   {
       $posts = Post::with('category')->orderBy('id','desc')->simplePaginate(2);
//6       $categories = Category::all();
       return view('posts.index', compact('posts'));
   }

   public function show($slug)
   {
       $post = Post::where('slug', $slug)->firstOrFail();
       $post->views +=1;
       $post->update();
       $like_posts = Post::where('category_id', '=', $post->category->id)->with('category')->orderBy('views', 'desc')->limit(3)->get();
       $commented_posts = Comment::with('post')->where('post_id', '=', $post->id)->orderBy('created_at','desc')->get();
        return view('posts.show', compact('post','like_posts','commented_posts'));

   }
}
