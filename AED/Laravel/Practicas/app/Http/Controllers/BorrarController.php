<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BorrarController extends Controller
{
    public function index()
    {
        $fichero = "Carpeta_Practica_17/practica18.csv";
        if (Storage::exists($fichero)){
            Storage::delete($fichero);
            echo "Fichero borrado";
        }
    }
}
