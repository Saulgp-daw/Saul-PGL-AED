<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LeerFicheroController extends Controller
{
    public function index(){
        $filepath = "/Carpeta_Practica_17/practica18.csv";
        $contenido = Storage::get($filepath);
        return view("contenido_fichero",compact("filepath", "contenido"));

    }
}
