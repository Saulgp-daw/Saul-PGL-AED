<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class TextAreaController extends Controller
{
    public function index(): View{
        return view("textarea");
    }

    public function convertirALista(Request $request){
        $textoAntesDeModificar = $request->input("lista");
        $textoAntesDeModificar = trim($textoAntesDeModificar);
        
        $textoSeparado = explode(",", $textoAntesDeModificar);
        //$textoSeparado = array_filter($textoSeparado, [$this, "eliminarElementosVacios"]); 
        $iteraciones = count($textoSeparado);
        // print_r($arrayFiltrado);
        // echo $iteraciones; //preguntar en clase, por alguna razón devuelve el array bien filtrado y las iteraciones pero en el view hace un array offset
        return view("textarea", compact("textoSeparado", "iteraciones"));
    }

    function eliminarElementosVacios($valor) {
        $valor = trim($valor);
        return $valor !== "";
    }
}
