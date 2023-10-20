<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\GestionarFichero;

class LoginRegistroController extends Controller
{
    function index(){
        if(!session()->has("nombreUsuario")){
            return view("registro");
        }else{
            return view("home");
        }

    }

    function home(){
        return view("home");
    }

    function registro(Request $request){
        $nombreUsuario = $request->input("nombreUsuario");
        $contrasenha = $request->input("contrasenha");
        $arrayDatos[] = [$nombreUsuario, $contrasenha];


        $gestorFichero = new GestionarFichero();
        if($gestorFichero->comprobarFicheroExiste(storage_path()."/Adicional/file.csv")){
            $gestorFichero->guardarDatosUsuarioFichero(storage_path()."/Adicional/file.csv", $arrayDatos);
        }else{
            echo "Hubo un error a la hora de abrir el fichero";
        }

        session()->put("nombreUsuario", $nombreUsuario);
        return view("home");
    }

    function login(Request $request){
        $nombreUsuario = $request->input("nombreUsuario");
        $contrasenha = $request->input("contrasenha");
        $gestorFichero = new GestionarFichero();

        if($gestorFichero->comprobarUsuarioExiste(storage_path()."/Adicional/file.csv", $nombreUsuario)){
            session()->put("nombreUsuario", $nombreUsuario);
            return view("home");

        }else{
            $mensaje = "El usuario no existe, inténtelo de nuevo";
            return view("login", compact("mensaje"));
        }
    }

    function redirigirLogin(){
        return view('login');
    }


}
