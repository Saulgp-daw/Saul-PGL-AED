<?php

namespace App\Http\Controllers;

use App\DAO\AsignaturaDAO;
use App\DAO\AsignaturaMatriculaDAO;
use Illuminate\Http\Request;
use App\Models\Asignatura;
use Illuminate\Support\Facades\DB;

class AsignaturaController extends Controller
{

    public function obtenerAsignaturas(){
        $pdo = DB::getPdo();
        $asignaturaDAO = new AsignaturaDAO($pdo);
        $asignaturas = $asignaturaDAO->findAll();
        foreach ($asignaturas as $asignatura) {
           echo $asignatura->id. " ".$asignatura->nombre. " ". $asignatura->curso . "</br>";
        }
    }

    public function guardarAsignatura(){
        $asignatura = new Asignatura(0, "LND", "1ºDAW");
        $pdo = DB::getPdo();
        $asignaturaDAO = new AsignaturaDAO($pdo);
        $asignaturaDAO->save($asignatura);
    }

    public function buscarPorId($id){
        $pdo = DB::getPdo();
        $asignaturaDAO = new asignaturaDAO($pdo);
        $asignatura = $asignaturaDAO->findById($id);

        if($asignatura){
            echo "Asignatura encontrada: ". $asignatura->id. " ".$asignatura->nombre. " ". $asignatura->curso;
        }
    }

    public function buscarPorCurso($nombreCurso){

        $pdo = DB::getPdo();
        $asignaturaDAO = new asignaturaDAO($pdo);
        $asignaturas = $asignaturaDAO->findByCurso($nombreCurso);

        foreach ($asignaturas as $asignatura) {
            echo $asignatura->curso." ".  $asignatura->id. " ".$asignatura->nombre.  " </br>";
         }
    }

    public function obtenerMatriculasConEstaAsignatura($idAsignatura){
        $pdo = DB::getPdo();
        $asignaturaMatriculaDAO = new AsignaturaMatriculaDAO($pdo);
        $matriculasConEstaAsignatura = $asignaturaMatriculaDAO->findMatriculasByAsignaturaId($idAsignatura);

        self::buscarPorId($idAsignatura);
        echo "<h3>Las asignaturas que tiene la matrícula con el id $idAsignatura son: </h3>";


        foreach ($matriculasConEstaAsignatura as $matricula) {
            echo $matricula->id." ". $matricula->dni." ". $matricula->year."</br>";
         }
    }

    public function actualizarAsignatura(){
        $asignatura = new Asignatura(9, "DEW", "2º DAW");
        $pdo = DB::getPdo();
        $asignaturaDAO = new AsignaturaDAO($pdo);
        $asignaturaDAO->update($asignatura);
    }

    public function eliminarAsignatura($id){
        $pdo = DB::getPdo();
        $asignaturaDAO = new AsignaturaDAO($pdo);
        $asignaturaMatriculaDAO = new AsignaturaMatriculaDAO($pdo);
        $asignaturaMatriculaDAO->deleteRelacionAsignatura($id);
        $asignaturaDAO->delete($id);
    }


    //hacer eliminar asignatura por curso
    //hacer tabla intermedia mañana






}
