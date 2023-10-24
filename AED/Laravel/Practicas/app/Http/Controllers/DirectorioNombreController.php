<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DirectorioNombreController extends Controller
{
    public function index(){
        return view("formularioDirectorio");
    }

    public function crearDirectorio(Request $request){
        $nombre = $request->input("nombre_carpeta");
        Storage::makeDirectory("/".$nombre, 0755, true);
        echo "Directorio creado";
    }
}
