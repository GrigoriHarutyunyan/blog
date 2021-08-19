<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function create(){
        $title = 'Register';
        return view('user.create', compact('title'));

    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email'=> 'required|email|unique:users',
            'password'=> 'required|confirmed'
        ]);

       $user = User::create([
           'name' => $request->name,
           'email'=> $request->email,
           'password' => bcrypt($request->password),
       ]);

       session()->flash('success', "Congratulation $request->name! You successfully signed up.");
       Auth::login($user);

       return redirect()->home();
    }
}
