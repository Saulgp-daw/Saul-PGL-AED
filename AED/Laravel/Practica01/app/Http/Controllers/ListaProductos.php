<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ListaProductos extends Controller
{
    public static function ejecutaGET()
    {
        echo "Ejecutando el controlador ListarProductos mediante get";
    }

    public static function ejecutaPOST()
    {
        echo "Ejecutando el controlador ListarProductos mediante POST";
    }
}
