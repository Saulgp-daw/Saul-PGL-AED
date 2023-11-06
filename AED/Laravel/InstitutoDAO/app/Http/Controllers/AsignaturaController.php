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
        // foreach ($asignaturas as $asignatura) {
        //    echo $asignatura->id. " ".$asignatura->nombre. " ". $asignatura->curso . "</br>";
        // }
        return $asignaturas;
    }

    public function guardarAsignatura($nombre, $curso){
        $asignatura = new Asignatura(0, $nombre, $curso);
        $pdo = DB::getPdo();
        $asignaturaDAO = new AsignaturaDAO($pdo);
        return $asignaturaDAO->save($asignatura);
    }

    public function buscarPorId($id){
        $pdo = DB::getPdo();
        $asignaturaDAO = new asignaturaDAO($pdo);
        $asignatura = $asignaturaDAO->findById($id);

        if($asignatura){
            echo "Asignatura encontrada: ". $asignatura->id. " ".$asignatura->nombre. " ". $asignatura->curso;
        }
    }

    public function comprobarExiste($nombre){
        $pdo = DB::getPdo();
        $asignaturaDAO = new AsignaturaDAO($pdo);
        return $asignaturaDAO->existsAsignatura($nombre);
    }

    public function buscarPorCurso($nombreCurso){

        $pdo = DB::getPdo();
        $asignaturaDAO = new asignaturaDAO($pdo);
        $asignaturas = $asignaturaDAO->findByCurso($nombreCurso);

        // foreach ($asignaturas as $asignatura) {
        //     echo $asignatura->curso." ".  $asignatura->id. " ".$asignatura->nombre.  " </br>";
        //  }
        return $asignaturas;
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

    public function actualizarAsignatura($id, $nombre, $curso){
        $asignatura = new Asignatura($id, $nombre, $curso);
        $pdo = DB::getPdo();
        $asignaturaDAO = new AsignaturaDAO($pdo);
        return $asignaturaDAO->update($asignatura);
    }

    public function eliminarAsignatura($id){
        $pdo = DB::getPdo();
        $asignaturaDAO = new AsignaturaDAO($pdo);
        $asignaturaMatriculaDAO = new AsignaturaMatriculaDAO($pdo);

        if($asignaturaMatriculaDAO->existsIdAsignatura($id)){
            $asignaturaMatriculaDAO->deleteRelacionAsignatura($id);
        }

        return $asignaturaDAO->delete($id);
    }


    //hacer eliminar asignatura por curso
    //hacer tabla intermedia mañana






}
