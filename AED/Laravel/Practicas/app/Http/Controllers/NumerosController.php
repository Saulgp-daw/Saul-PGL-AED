<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NumerosController extends Controller
{
    public function mostrarVista(){
        $num_aleatorios = [];
        for($i = 0; $i < 100; $i++){
            array_push($num_aleatorios, random_int(0, 100));
        }


        return view('numeros', compact('num_aleatorios'));
    }
}
