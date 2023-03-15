<?php

namespace App\Http\Controllers;

use App\Models\Post as ModelsPost;
use Illuminate\Http\Request;

class Post extends Controller
{
    public function show($slug, ModelsPost $post){
        $post = $post->with('user')->where('slug', $slug)->first();
        return view('site.post',['title' => 'Post','post' => $post]);
    }
}
