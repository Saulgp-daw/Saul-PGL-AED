<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\GestionarFichero;

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
        return view("home");
    }

    function registro(Request $request)
    {
        $nombreUsuario = $request->input("nombreUsuario");
        $contrasenha = $request->input("contrasenha");
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
