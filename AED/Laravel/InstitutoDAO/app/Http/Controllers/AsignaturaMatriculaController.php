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

    public function devolverAsignaturasDeMatricula($id){
        $pdo = DB::getPdo();
        $asignaturaMatriculaDAO = new AsignaturaMatriculaDAO($pdo);
        return $asignaturaMatriculaDAO->findAsignaturasByMatriculaId($id);
    }

    public function asignarRelacionMatriculaAsignatura($idMatricula, $idAsignatura){
        $pdo = DB::getPdo();
        $asignaturaMatriculaDAO = new AsignaturaMatriculaDAO($pdo);
        return $asignaturaMatriculaDAO->assignRelacionMatriculaAsignatura($idMatricula, $idAsignatura);
    }

    public function buscarAlumnosPorAnhoYNombreAsignatura($nombre = "AED", $year=2006){
        $pdo = DB::getPdo();
        $asignaturaMatriculaDAO = new AsignaturaMatriculaDAO($pdo);
        return $asignaturaMatriculaDAO->buscarAlumnoConAsignaturaPorYearYNombre($nombre, $year);

    }
}
