<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    //

    public function index(){
        return view('formularioUsuario');
    }

    public function procesar(Request $request){
        if($request->input("nombre")){
            session()->put("nombre", $request->input("nombre"));
        }
        if($request->input("edad")){
            session()->put("edad", $request->input("edad"));
        }
        if($request->input("gustos")){
            session()->put("gustos", $request->input("gustos"));
        }

        return view("formularioUsuario");
    }
}
