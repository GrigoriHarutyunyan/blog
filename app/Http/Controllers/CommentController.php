<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $slug){
        $request->validate([
            'comment'=>'required',
            'email'=>'required|email',
            'name'=>"required"
        ]);
        Comment::create($request->all());
        $request->session()->flash('success', 'Comment added');
        return redirect()->back();
    }


}
