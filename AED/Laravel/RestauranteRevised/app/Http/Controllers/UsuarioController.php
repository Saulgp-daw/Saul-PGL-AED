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
        $telefono = trim($request->input("telefono"));

        if ($contrasenha != $contrasenha2) {
            return  redirect('/registro_form')->with('error', 'No coinciden las contraseñas.');
        }

        $hash_contrasenha = password_hash(trim($contrasenha), PASSWORD_DEFAULT);

        $usuario = new Usuario(intval($telefono), $nombre, $hash_contrasenha);

        $pdo = DB::getPdo();
        $usuarioDao = new UsuarioDAO($pdo);

        $existente = $usuarioDao->findById($telefono);

        if($existente){
            return  redirect('/registro_form')->with('error', 'Ya existe un usuario con este teléfono.');
        }

        $usuarioNuevo = $usuarioDao->save($usuario);

        if ($usuarioNuevo) {
            return  redirect('/login_form');
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
            return redirect('/login_form')->with('error', 'Usuario inexistente.');
        }

        if (trim($telefono) == $usuario->getTelefono() && password_verify($contrasenha, $usuario->getContrasenha())) {
            session(['usuario_tel' => $telefono]);
            //$dato = session()->get('usuario');
            //echo $dato;
            return redirect("/home");
        } else {
            return redirect('/login_form')->with('error', 'Credenciales incorrectas.');
        }
    }

    public function logout(){
        session()->flush();
        return redirect('/registro_form')->with('error', 'Sesión finalizada.');
    }

    public function perfil($telefono){
        $telefonoSesion = session()->get('usuario_tel');

        $pdo = DB::getPdo();
        $usuarioDao = new UsuarioDAO($pdo);
        $reservaDao = new ReservaDAO($pdo);
        $reservas = [];
        $reservasDeldia = [];
        $usuario = $usuarioDao->findById($telefono);
        $usuarioSesion = $usuarioDao->findById($telefonoSesion);



        if($usuario){
            if($usuario->getTelefono() != $telefonoSesion && $usuarioSesion->getRol() == "CLIENTE"){
                return redirect('/home')->with('error', 'No tienes permisos para ver otros usuarios.');
            }
            $reservasDeldia = $reservaDao->reservasDelDia();
            $reservas = $reservaDao->findByTelefono($usuario->getTelefono());
            return view("perfil", compact("usuario", "reservas", "telefonoSesion", "reservasDeldia"));
        }

        return redirect('/home')->with('error', 'Usuario inexistente.');
    }

    public function listaUsuarios(){
        $telefonoSesion = session()->get('usuario_tel');
        $pdo = DB::getPdo();
        $usuarioDao = new UsuarioDAO($pdo);
        $listaUsuarios = $usuarioDao->findAll();




        return view("lista",compact("telefonoSesion", "listaUsuarios"));
    }
}
