<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FechaController extends Controller
{
    public function mostrarFecha(){
        $diaActual = date('Y-m-d');
        $horaActual = date('H:i:s');
        return view('fecha', compact('diaActual', 'horaActual'));
    }

    public function desde(){
        return view('fecha_desde');
    }
}
