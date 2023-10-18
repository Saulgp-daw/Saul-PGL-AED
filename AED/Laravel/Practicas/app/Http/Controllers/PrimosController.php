<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrimosController extends Controller
{
    public function mostrarPrimos()
    {
        $coleccion = collect([1, 2, 3, 5, 7, 11, 13, 17, 19]);
        return view('listarPrimos', compact('coleccion'));
    }
}
