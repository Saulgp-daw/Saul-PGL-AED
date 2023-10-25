<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DriveController extends Controller
{
    public function index()
    {
        $ficheros = Storage::allFiles("/Archivos");
        return view("drive", compact("ficheros"));
    }

    public function descargar($archivo)
    {
        if (Storage::exists("Archivos/" . $archivo)) {
            return response()->download(storage_path("app/Archivos/" . $archivo));
        }
    }

    public function borrar($archivo)
    {
        if (Storage::exists("Archivos/".$archivo)){
            Storage::delete("Archivos/".$archivo);
        }
        return redirect("/");

    }
}
