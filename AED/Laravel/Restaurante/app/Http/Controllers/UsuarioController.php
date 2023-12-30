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
        $telefono = $request->input("telefono");

        $usuario = new Usuario(intval($telefono), $nombre, $contrasenha  );

        $pdo = DB::getPdo();
        $usuarioDao = new UsuarioDAO($pdo);
        
        $usuarioNuevo = $usuarioDao->save($usuario);

        if($usuarioNuevo){
            echo "Éxito";
        }
        
    }
}
