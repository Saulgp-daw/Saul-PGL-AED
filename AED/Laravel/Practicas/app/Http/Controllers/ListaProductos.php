<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ListaProductos extends Controller
{
    public static function respuesta()
    {
        $metodo = $_SERVER['REQUEST_METHOD'];
        return view('listar', compact('metodo'));
    }

}
