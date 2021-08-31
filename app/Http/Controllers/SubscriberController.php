<?php

namespace App\Http\Controllers;

use App\Models\Subscribers;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function store(Request $request){

        $request->validate([
           'email'=>'required|email|unique:subscribers',
        ]);

        Subscribers::create($request->all());
        $request->session()->flash('success', 'You have successfully subscribed');
        return redirect()->back();
    }
}
