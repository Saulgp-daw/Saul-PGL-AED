<?php

namespace App\Http\Controllers;

use App\DAO\ReservaDAO;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Usuario;
use App\DAO\UsuarioDAO;

class UsuarioController extends Controller
{
    public static function index($mensaje = "")
    {
        return view("registro", compact("mensaje"));
    }

    public function registro(Request $request)
    {
        $nombre = $request->input("nombre");
        $contrasenha = $request->input("contrasenha");
        $contrasenha2 = $request->input("contrasenha2");
        $telefono = $request->input("telefono");

        if ($contrasenha != $contrasenha2) {
            return  self::index("Las contraseñas no coinciden");
        }

        $hash_contrasenha = password_hash(trim($contrasenha), PASSWORD_DEFAULT);

        $usuario = new Usuario(intval(trim($telefono)), $nombre, $hash_contrasenha);

        $pdo = DB::getPdo();
        $usuarioDao = new UsuarioDAO($pdo);

        $usuarioNuevo = $usuarioDao->save($usuario);

        if ($usuarioNuevo) {
            return  self::index("Exito!");
        }
    }

    public function loginForm($mensaje = "")
    {
        return view("login", compact("mensaje"));
    }

    public function login(Request $request)
    {
        $contrasenha = $request->input("contrasenha");
        $telefono = $request->input("telefono");
        $pdo = DB::getPdo();
        $usuarioDao = new UsuarioDAO($pdo);

        $usuario = $usuarioDao->findById(trim($telefono));

        if (!$usuario) {
            return self::loginForm("Usuario inexistente");
        }

        if (trim($telefono) == $usuario->getTelefono() && password_verify($contrasenha, $usuario->getContrasenha())) {
            session(['usuario_tel' => $telefono]);
            //$dato = session()->get('usuario');
            //echo $dato;
            return redirect("/home");
        } else {
            return self::loginForm("Credenciales incorrectas");
        }
    }

    public function logout(){
        session()->flush();
        return self::index("Sesión finalizada");
    }

    public function perfil($telefono){
        if(!session()->has('usuario_tel')){
            return self::index("Autentíquese antes de entrar");
        }

        $pdo = DB::getPdo();
        $usuarioDao = new UsuarioDAO($pdo);
        $reservaDao = new ReservaDAO($pdo);
        $reservas = [];
        //$telefono = session()->get('usuario_tel');

        $usuario = $usuarioDao->findById($telefono);

        if($usuario){
            $reservas = $reservaDao->findByTelefono($usuario->getTelefono());
        }

        return view("perfil", compact("usuario", "reservas", "telefono"));
    }
}
