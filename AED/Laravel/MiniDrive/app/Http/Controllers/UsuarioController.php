<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Http\Controllers\DriveController;
use Illuminate\Support\Facades\Storage;

class UsuarioController extends Controller
{
    public function index()
    {
        return view("registro");
    }

    public function registro(Request $request)
    {
        $nickname = $request->input("nickname");
        $email = $request->input("email");
        $password = $request->input("password");

        $nuevoUsuario = new Usuario($nickname, $email, $password);
        //var_dump($usuario);
        //die();

        $usuarios = self::LeerFicheroPHPPuro();
        $mensaje = "Nickname ya escogido";
        $existe = false;
        if ($usuarios) {
            foreach ($usuarios as $usuario) {
                if ($usuario[0] == $nuevoUsuario->getNickname()) {
                    $existe = true;
                }
            }
            if ($existe) {
                return self::registroForm($mensaje);
            } else {
                self::guardarUsuarioPHPPuro($nuevoUsuario);
                return DriveController::index($nuevoUsuario->getNickname());
            }
        }



        //self::guardarUsuarioPHPPuro($usuario);
        //$request->session()->put("usuario", $usuario); no funciona

        //return DriveController::index($usuario->getNickname());
        //return redirect("/home");
    }

    public function registroForm($mensaje = "")
    {
        return view("registro", compact("mensaje"));
    }

    public function logout(Request $request)
    {
        unset($_SESSION['usuario']);
        return self::index();
    }

    public static function loginForm($mensaje = "")
    {
        return view("login", compact("mensaje"));
    }

    public function login(Request $request)
    {
        $nickname = $request->input("nickname");
        $password = $request->input("password");
        $usuarios = self::LeerFicheroPHPPuro();
        $mensaje = "Credenciales incorrectas.";
        if ($usuarios) {
            foreach ($usuarios as $usuario) {
                if ($usuario[0] == $nickname && $usuario[2] == $password) {
                    //return DriveController::index($nickname);
                    return redirect()->route('drive')->with($nickname);
                }
            }
        }
        return self::loginForm($mensaje);
    }

    public static function guardarUsuarioPHPPuro($usuario)
    {

        $rutaFichero = storage_path("app/Archivos/registros.csv");
        $contenidoFichero = self::LeerFicheroPHPPuro();
        //var_dump($contenidoFichero);
        //die();
        $nuevoUsuario = array(
            $usuario->getNickname(),
            $usuario->getEmail(),
            $usuario->getPassword()
        );
        if($contenidoFichero == null){
            $contenidoFichero = [];
        }
        array_push($contenidoFichero, $nuevoUsuario);


        if (file_exists($rutaFichero)) {
            $fichero = fopen($rutaFichero, 'w');
            foreach ($contenidoFichero as $user) {
                fputcsv($fichero, $user, ";");
            }
        }

        fclose($fichero);
        //var_dump($contenidoFichero);
        //die();
    }

    public static function LeerFicheroPHPPuro()
    {
        $contenido = null;

        if(!Storage::exists("Archivos/registros.csv")){
            Storage::makeDirectory("/Archivos/", 0755, true);
            Storage::put('/Archivos/registros.csv', 'null;null;null');
        }

        if (($open = fopen(storage_path("app/Archivos/registros.csv"), "r")) !== FALSE) {
            while (($data = fgetcsv($open, 1000, ";")) !== FALSE) {
                $contenido[] = $data;
            }
            fclose($open);

            return $contenido;
        }

        return $contenido;
    }
}
