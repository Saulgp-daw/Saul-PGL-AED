<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ColoresController extends Controller
{
    public function index(){
        return view('formulario');
    }

    public function agregarColor(Request $request ){
        $nuevoColor = $request->get('color');//$nuevoColor = $_GET['color'];

        $colores = session()->get("colores")??[];

        array_push($colores,$nuevoColor);
        session()->put("colores",$colores);

        $num = rand(0, count($colores)-1);
        $colorFavorito = $colores[$num];

        return view("formulario", compact("colorFavorito"));
    }
}
