<?php

namespace App\Http\Controllers;

use App\Models\Usuarios as UsuariosModel;
use App\Models\RecuperarSenhas;
use App\Mail\RecuperarSenhaEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

    public function recuperar(Request $request){
        $this->validate($request, ['email' => 'required|email']);
        $usuarios = UsuariosModel::where('email', $request->input('email'))->first();

        if(!$usuarios){
            return response()->json(['message' => 'Ocorreu um erro, email ou senha invalidos'], 401);
        }

        $date = date_create();
        $date->modify('+5 minutes');
        $token = md5(uniqid());

        $recuperar_senha = new RecuperarSenhas();
        $recuperar_senha_destroy = RecuperarSenhas::where('id_usuarios', $usuarios['id']);
        $recuperar_senha_destroy->delete();

        $recuperar_senha->id_usuarios = $usuarios['id'];
        $recuperar_senha->token = $token;
        $recuperar_senha->time = $date->format('Y-m-d H:i:s');
        $recuperar_senha->save();
    
        Mail::to($usuarios['email'])->send(new RecuperarSenhaEmail($usuarios['fullname'], $token));

        return response()->json(['message' => 'Enviado com sucesso','status' => true], 200);
    }

    public function redefinir(Request $request, $token) 
    {
        $this->validate($request, ['password' => 'required']);

        $recuperar_senha = RecuperarSenhas::where('token', $token)->first();
        
        if(!$recuperar_senha){
            return response()->json(['message' => 'Ocorreu um erro'], 401);
        }

        $usuarios = UsuariosModel::find($recuperar_senha['id_usuarios']);
        $usuarios->password = md5($request->input('password'));
        $usuarios->save();

        return response()->json(['message' => 'Senha auterada com sucesso!','status' => true], 200);
    }


    public function logout()
    {
        if(isset($_SESSION['userId'])){
            session_destroy();
            return redirect('/');
        }
    }
}
