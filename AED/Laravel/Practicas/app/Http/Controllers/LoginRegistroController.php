<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GestionarFichero;

class LoginRegistroController extends Controller
{
    private $rutaCSV;

    public function __construct()
    {
        $this->rutaCSV = storage_path() . "/Adicional/file.csv";
    }

    public function obtenerRutaCSV()
    {
        return $this->rutaCSV;
    }

    function index()
    {
        if (!session()->has("nombreUsuario")) {
            return view("registro");
        } else {
            return view("home");
        }
    }

    function home()
    {
        if (session()->has("nombreUsuario")) {
            return view("home");
        }else{
            return redirect()->action([LoginRegistroController::class, 'index']);
        }

    }

    function registro(Request $request)
    {
        $nombreUsuario = $request->input("nombreUsuario");
        $contrasenha = $request->input("contrasenha");

        if ($nombreUsuario == ""|| $contrasenha == "") {
            $mensaje = "El usuario o contraseña están vacíos";
            return view("registro", compact("mensaje"));
        }
        $arrayDatos[] = [$nombreUsuario, $contrasenha];


        $gestorFichero = new GestionarFichero();

        if (!$gestorFichero->comprobarUsuarioExiste(self::obtenerRutaCSV(), $nombreUsuario)) {
            $gestorFichero->guardarDatosUsuarioFichero(self::obtenerRutaCSV(), $arrayDatos);
        } else {
            $mensaje = "El usuario con este nombre ya está registrado, inténtelo de nuevo";
            return view("registro", compact("mensaje"));
        }


        session()->put("nombreUsuario", $nombreUsuario);
        return redirect()->action([LoginRegistroController::class, 'index']);
    }

    function urlRedirect($view){
        if (session()->has("nombreUsuario")) {
            return view($view);
        }else{
            return redirect()->action([LoginRegistroController::class, 'index']);
        }
    }

    function login(Request $request)
    {
        $nombreUsuario = $request->input("nombreUsuario");
        $contrasenha = $request->input("contrasenha");
        $gestorFichero = new GestionarFichero();

        if ($gestorFichero->credencialesCorrectas(self::obtenerRutaCSV(), $nombreUsuario, $contrasenha)) {
            session()->put("nombreUsuario", $nombreUsuario);
            return redirect()->action([LoginRegistroController::class, 'index']);
        } else {
            $mensaje = "El usuario o contraseña están equivocadas";
            return view("login", compact("mensaje"));
        }
    }

    function logout()
    {
        session()->forget("nombreUsuario");
        return redirect()->action([LoginRegistroController::class, 'index']);
    }

    function redirigirLogin()
    {
        return view('login');
    }

    function redirigirRegistro()
    {
        return view('registro');
    }
}
