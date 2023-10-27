<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class DescargarController extends Controller
{
    public function index(){
        $filepath = "/Carpeta_Practica_17";
        $ficheros = Storage::allFiles($filepath);
        return view('listarArchivos',compact('ficheros'));
    }

    public function descargar($rutaArchivo){
        //$rutaArchivo = $request->get("fichero");
        return response()->download(storage_path("app/Carpeta_Practica_17/".$rutaArchivo));
    }
}
