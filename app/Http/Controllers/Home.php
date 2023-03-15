<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Home extends Controller
{
    public function index()
    {
        // dd(Auth::user());
        // $posts = Post::with('user')->get();
        return view('site.home',['title' => 'Home']);
    }

    public function formulario()
    {
        return view('site.formulario',['title' => 'formulario']);
    }
}
