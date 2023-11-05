<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\DAO\AsignaturaMatriculaDAO;

class AsignaturaMatriculaController extends Controller
{
    public function eliminarRelacionMatricula($id){
        $pdo = DB::getPdo();
        $asignaturaMatriculaDAO = new AsignaturaMatriculaDAO($pdo);
        $asignaturaMatriculaDAO->deleteRelacionMatricula($id);
    }
}
