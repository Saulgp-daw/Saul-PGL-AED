<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Usuario;
use App\DAO\UsuarioDAO;

class UsuarioController extends Controller
{
    public function registroForm($mensaje = ""){
        return view("registro", compact("mensaje"));
    }

    public function registro(Request $request){
        $nombre = $request->input("nombre");
        $contrasenha = $request->input("contrasenha");
        $contrasenha2 = $request->input("contrasenha2");
        $telefono = $request->input("telefono");

        if($contrasenha != $contrasenha2){
            return  self::registroForm("Las contraseñas no coinciden");
        }

        $hash_contrasenha = password_hash($contrasenha, PASSWORD_DEFAULT);

        $usuario = new Usuario(intval($telefono), $nombre, $hash_contrasenha  );

        $pdo = DB::getPdo();
        $usuarioDao = new UsuarioDAO($pdo);

        $usuarioNuevo = $usuarioDao->save($usuario);

        if($usuarioNuevo){
            return  self::registroForm("Exito!");
        }
    }

    public function loginForm($mensaje = ""){
        return view("login", compact("mensaje"));
    }

    public function login(Request $request){
        $contrasenha = $request->input("contrasenha");
        $telefono = $request->input("telefono");
        $pdo = DB::getPdo();
        $usuarioDao = new UsuarioDAO($pdo);

        $usuario = $usuarioDao->findById($telefono);

        if($usuario){
            if($usuario->getTelefono() == $telefono && $usuario->getContrasenha() == $contrasenha){
                return self::loginForm("Exito!");
            }


        }

    }

}
