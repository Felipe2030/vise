<?php

namespace App\Http\Controllers;

use App\Models\Usuarios as UsuariosModel;
use App\Models\RecuperarSenhas;
use App\Mail\RecuperarSenhaEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class Usuarios extends Controller
{
    public function getUsuarioLogado()
    {
        $usuario = Auth::user();
        return response()->json($usuario);
    }

    public function cadastrar(Request $request)
    {
        $email    = (!!trim($request->input('email'))) ? $request->input('email') : false;
        $password = (!!trim($request->input('password'))) ? $request->input('password') : false;

        if(!$email || !$password):
            return response()->json(['message' => 'Preencha todos os campos!','status' => false], 401);
        endif;

        try {
            $usuarios = new UsuariosModel();

            $usuarios->email              = $email;
            $usuarios->password           = md5($password);
            $usuarios->id_status_usuarios = 1;
            $usuarios->save();

            return response()->json(['message' => 'Enviado com sucesso!','status' => true, 'id_usuarios' => $usuarios->id], 200);
        } catch(Exception $e) {
            return response()->json(['message' => 'Não foi possivel enviar!','status' => false], 401);
        }
    }

    public function cadastrarPessoa(Request $request, $id)
    {
        $name     = (!!trim($request->input('name'))) ? $request->input('name') : false;
        $telefone = (!!trim($request->input('telefone'))) ? $request->input('telefone') : false;

        if(!$name || !$telefone):
            return response()->json(['message' => 'Preencha todos os campos!','status' => false], 401);
        endif;
     
        try {
            $usuarios = UsuariosModel::find($id);

            $usuarios->fullname           = $name;
            $usuarios->telefone           = $telefone;
            $usuarios->id_status_usuarios = 2;
            $usuarios->save();

            return response()->json(['message' => 'Enviado com sucesso!','status' => true, 'id_usuarios' => $usuarios->id], 200);
        } catch(Exception $e) {
            return response()->json(['message' => 'Não foi possivel enviar!','status' => false], 401);
        }
    }

    public function cadastrarPessoaTipo(Request $request, $id)
    {
        $estabelecimento  = (!!trim($request->input('estabelecimento'))) ? $request->input('estabelecimento') : false;
        $documento        = (!!trim($request->input('documento'))) ? $request->input('documento') : false;
        $numero_documento = (!!trim($request->input('numero_documento'))) ? $request->input('numero_documento') : false;

        if(!$estabelecimento || !$documento || !$numero_documento):
            return response()->json(['message' => 'Preencha todos os campos!','status' => false], 401);
        endif;

        try {
            $usuarios = UsuariosModel::find($id);

            $usuarios->estabelecimento    = $estabelecimento;
            $usuarios->documento          = $documento;
            $usuarios->numero_documento   = $numero_documento;
            $usuarios->id_status_usuarios = 3;
            $usuarios->save();

            $_SESSION['userId'] = $usuarios->id;
            return response()->json(['message' => 'Enviado com sucesso!','status' => true, 'id_usuarios' => $usuarios->id], 200);
        } catch(Exception $e) {
            return response()->json(['message' => 'Não foi possivel enviar!','status' => false], 401);
        }
    }

    public function login(Request $request)
    {   
        $email    = (!!trim($request->input('email'))) ? $request->input('email') : false;
        $password = (!!trim($request->input('password'))) ? $request->input('password') : false;

        if(!$email || !$password):
            return response()->json(['message' => 'Preencha todos os campos!','status' => false], 401);
        endif;

        $usuarios = UsuariosModel::where('email', $email)->first();

        if(!$usuarios):
            return response()->json(['message' => 'Email ou senha invalidos!','status' => false], 401);
        endif;

        if(md5($password) != $usuarios->password):
            return response()->json(['message' => 'Email ou senha invalidos!','status' => false], 401);
        endif;

        $_SESSION['userId'] = $usuarios->id;
        return response()->json(['message' => 'Logado com sucesso','status' => true], 200);
    }

    public function recuperar(Request $request){
        $email = (!!trim($request->input('email'))) ? $request->input('email') : false;

        if(!$email):
            return response()->json(['message' => 'Preencha todos os campos!','status' => false], 401);
        endif;

        $usuarios = UsuariosModel::where('email', $email)->first();

        if(!$usuarios):
            return response()->json(['message' => 'Email ou senha invalidos!','status' => false], 401);
        endif;

        $date  = date_create();
        $token = md5(uniqid());
        $date->modify('+5 minutes');

        try {
            $recuperar_senha = new RecuperarSenhas();
            $recuperar_senha_destroy = RecuperarSenhas::where('id_usuarios', $usuarios['id']);
            $recuperar_senha_destroy->delete();

            $recuperar_senha->id_usuarios = $usuarios['id'];
            $recuperar_senha->token = $token;
            $recuperar_senha->time = $date->format('Y-m-d H:i:s');
            $recuperar_senha->save();
    
            Mail::to($usuarios['email'])->send(new RecuperarSenhaEmail($usuarios['fullname'], $token));

            return response()->json(['message' => 'Enviado com sucesso!','status' => true], 200);
        } catch(Exception $e) {
            return response()->json(['message' => 'Não foi possivel enviar!','status' => false], 401);
        }
    }

    public function redefinir(Request $request, $token) 
    {
        $password = (!!trim($request->input('password'))) ? $request->input('password') : false;

        if(!$password):
            return response()->json(['message' => 'Preencha todos os campos!','status' => false], 401);
        endif;
        
        try {
            $recuperar_senha = RecuperarSenhas::where('token', $token)->first();

            if(!$recuperar_senha):
                return response()->json(['message' => 'Token não encontrado!','status' => false], 401);
            endif;

            $usuarios = UsuariosModel::find($recuperar_senha['id_usuarios']);
            $usuarios->password = md5($password);
            $usuarios->save();

            return response()->json(['message' => 'Senha alterada com sucesso!','status' => true], 200);
        } catch(Exception $e) {
            return response()->json(['message' => 'Não foi possivel enviar!','status' => false], 401);
        }
    }

    public function update(Request $request, $id)
    {
        $email            = (!!trim($request->input('email'))) ? $request->input('email') : false;
        $name             = (!!trim($request->input('name'))) ? $request->input('name') : false;
        $telefone         = (!!trim($request->input('telefone'))) ? $request->input('telefone') : false;
        $estabelecimento  = (!!trim($request->input('estabelecimento'))) ? $request->input('estabelecimento') : false;
        $documento        = (!!trim($request->input('documento'))) ? $request->input('documento') : false;
        $numero_documento = (!!trim($request->input('numero_documento'))) ? $request->input('numero_documento') : false;
        $cidade           = (!!trim($request->input('cidade'))) ? $request->input('cidade') : false;
        $endereco         = (!!trim($request->input('endereco'))) ? $request->input('endereco') : false;
        $numero           = (!!trim($request->input('numero'))) ? $request->input('numero') : false;
        $cep              = (!!trim($request->input('cep'))) ? $request->input('cep') : false;

        if(!$email || !$name || !$telefone || !$estabelecimento || !$documento || !$numero_documento || !$cidade || !$endereco || !$numero || !$cep):
            return response()->json(['message' => 'Preencha todos os campos!','status' => false], 401);
        endif;
     
        try {
            $usuarios = UsuariosModel::find($id);

            $usuarios->email              = $email;
            $usuarios->fullname           = $name;
            $usuarios->telefone           = $telefone;
            $usuarios->estabelecimento    = $estabelecimento;
            $usuarios->documento          = $documento;
            $usuarios->numero_documento   = $numero_documento;
            $usuarios->cidade             = $cidade;
            $usuarios->endereco           = $endereco;
            $usuarios->numero             = $numero;
            $usuarios->cep                = $cep;
            $usuarios->id_status_usuarios = 4;
            $usuarios->save();

            return response()->json(['message' => 'Enviado com sucesso!','status' => true], 200);
        } catch(Exception $e) {
            return response()->json(['message' => 'Não foi possivel enviar!','status' => false], 401);
        }
    }

    public function logout()
    {
        if(isset($_SESSION['userId'])){
            session_destroy();
            return redirect('/');
        }
    }
}
