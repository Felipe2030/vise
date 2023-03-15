<?php

namespace App\Http\Controllers;

use App\Models\Usuarios as UsuariosModel;
use Illuminate\Http\Request;

class Usuarios extends Controller
{
    public function cadastrar(Request $request)
    {
        $this->validate($request, ['email' => 'required|email', 'password' => 'required']);
        
        $usuarios = new UsuariosModel();

        $usuarios->email    = $request->input('email');
        $usuarios->password = md5($request->input('password'));
        $usuarios->fullname = "";
        $usuarios->telefone = "";
        $usuarios->estabelecimento = "";
        $usuarios->documento = "";
        $usuarios->numero_documento = "";
        $usuarios->id_status_usuarios = 1;
        $usuarios->save();

        return response()->json(['message' => 'Usuario cadastrado com sucesso', 'id_usuarios' => $usuarios->id], 200);
    }

    public function cadastrarPessoa(Request $request, $id)
    {
        $this->validate($request, ['name' => 'required', 'telefone' => 'required']);
        
        $usuarios = UsuariosModel::find($id);
        $usuarios->fullname = $request->input('name');
        $usuarios->telefone = $request->input('telefone');
        $usuarios->id_status_usuarios = 2;
        $usuarios->save();

        return response()->json(['message' => 'Usuario atualizado com sucesso'], 200);
    }

    public function cadastrarPessoaTipo(Request $request, $id)
    {
        $this->validate($request, ['estabelecimento' => 'required', 'documento' => 'required', 'numero_documento' => 'required']);
        
        $usuarios = UsuariosModel::find($id);
        $usuarios->estabelecimento = $request->input('estabelecimento');
        $usuarios->documento = $request->input('documento');
        $usuarios->numero_documento = $request->input('numero_documento');
        $usuarios->id_status_usuarios = 3;
        $usuarios->save();

        $_SESSION['userId'] = $usuarios->id;
        return response()->json(['message' => 'Usuario atualizado com sucesso'], 200);
    }

    public function login(Request $request)
    {
        $this->validate($request, ['email' => 'required|email', 'password' => 'required']);
        $usuarios = UsuariosModel::where('email', $request->input('email'))->first();

        if(!$usuarios){
            return response()->json(['message' => 'Ocorreu um erro, email ou senha invalidos'], 401);
        }

        if(md5($request->input('password')) != $usuarios->password){
            return response()->json(['message' => 'Ocorreu um erro, email ou senha invalidos'], 401);
        }
        
        $_SESSION['userId'] = $usuarios->id;
        return response()->json(['message' => 'Logado com sucesso','status' => true], 200);
    }

    public function logout()
    {
        if(isset($_SESSION['userId'])){
            session_destroy();
            return redirect('/');
        }
    }
}
