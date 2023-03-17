<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Home extends Controller
{
    public function index()
    {
        return view('site.dashboard',['title' => 'Dashboard']);
    }

    public function pedido()
    {
        return view('site.pedidos',['title' => 'Pedidos']);
    }
}
