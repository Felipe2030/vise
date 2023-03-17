<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RecuperarSenhas;

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

    public function redefinir($token) 
    {
        $recuperar_senha = RecuperarSenhas::where('token', $token)->first();
        $expiration = date_create($recuperar_senha['time']);
        $now = date_create('now');
        
        if($now >= $expiration){
            echo "Token invalid";
            exit;
        }

        return view('site.redefinir-senha', ['title' => 'Redefinir Senha', 'token' => $token]);
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

    public function modal($page)
    {
        return view('components.'.$page, ['title' => 'Modal']);
    }
}
