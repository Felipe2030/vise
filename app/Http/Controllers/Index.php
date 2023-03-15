<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class Index extends Controller
{
    public function login()
    {
        return view('site.index', ['title' => 'Login']);
    }

    public function recuperar()
    {
        return view('site.recuperacao-senha', ['title' => 'Recuperar Senha']);
    }

    public function cadastrar()
    {
        return view('site.cadastrar-usuarios', ['title' => 'Cadastrar']);
    }

    public function cadastrarPessoa()
    {
        return view('site.cadastrar-pessoa', ['title' => 'Cadastrar Pessoa']);
    }

    public function cadastrarPessoaTipo()
    {
        return view('site.cadastrar-pessoa-tipo', ['title' => 'Cadastrar Tipo Pessoa']);
    }
}
