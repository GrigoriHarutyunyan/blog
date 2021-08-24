<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->FirstorFail();
//        $categories = Category::all();
        $posts = $category->posts()->orderBy('id','desc')->simplePaginate(2);
        return view('categories.show', compact('category', 'posts'));
    }
}
