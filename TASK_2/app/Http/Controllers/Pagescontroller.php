<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Pagescontroller extends Controller
{
    //
    public function contact(){
        return view('contact');
    }
    public function profile(){
        $name= "Md Al Muzahid Nayim";
        return view('myprofile')->with('name',$name);
    }
    public function login(){
        return view('login');
    }
}
