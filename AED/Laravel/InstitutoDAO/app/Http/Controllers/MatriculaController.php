<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matricula;
use Illuminate\Support\Facades\DB;
use App\DAO\MatriculaDAO;
use App\DAO\AsignaturaDAO;
use App\DAO\AsignaturaMatriculaDAO;

class MatriculaController extends Controller
{

    public function obtenerMatriculas(){
        $pdo = DB::getPdo();
        $matriculaDAO = new MatriculaDAO($pdo);
        $matriculas = $matriculaDAO->findAll();
        // foreach ($matriculas as $matricula) {
        //    echo $matricula->id. " ".$matricula->dni. " ". $matricula->year. " </br>";
        // }

        return $matriculas;
    }

    public function obtenerAsignaturasDeLaMatricula($id){
        $pdo = DB::getPdo();
        $matriculaDAO = new AsignaturaMatriculaDAO($pdo);
        $asignaturasDeLaMatricula = $matriculaDAO->findAsignaturasByMatriculaId($id);

        self::buscarPorId($id);
        echo "<h3>Las asignaturas que tiene la matrícula con el id $id son: </h3>";


        foreach ($asignaturasDeLaMatricula as $asignatura) {
            echo $asignatura->id. " ".$asignatura->nombre. " ". $asignatura->curso . "</br>";
         }

         return $asignaturasDeLaMatricula;
    }

    public function guardarMatricula($id, $dni, $year){
        $matricula = new Matricula($id, $dni, $year);
        $pdo = DB::getPdo();
        $matriculaDAO = new MatriculaDAO($pdo);
        return $matriculaDAO->save($matricula);
    }

    public static function buscarPorId($id){
        $pdo = DB::getPdo();
        $matriculaDAO = new MatriculaDAO($pdo);
        $matricula = $matriculaDAO->findById($id);

        if($matricula){
            echo "Matricula encontrada: ID-". $matricula->id. " DNI-".$matricula->dni. " Año-". $matricula->year. "</br>";
        }
    }

    public function buscarPorDni($dni){
        $pdo = DB::getPdo();
        $matriculaDAO = new MatriculaDAO($pdo);
        $matriculas = $matriculaDAO->findByDni($dni); //la relación es N a 1, un alumno puede tener varias matrículas

        // foreach ($matriculas as $matricula) {
        //     echo $matricula->id. " ".$matricula->dni. " ". $matricula->year. " </br>";
        //  }

         return $matriculas;
    }

    public function buscarPorAnho($year){
        $pdo = DB::getPdo();
        $matriculaDAO = new MatriculaDAO($pdo);
        $matriculas = $matriculaDAO->findByYear($year); //la relación es N a 1, un alumno puede tener varias matrículas

         return $matriculas;
    }

    public function actualizarMatricula(){
        $matricula = new Matricula(5, "12345678Z", 2023);
        $pdo = DB::getPdo();
        $matriculaDAO = new MatriculaDAO($pdo);
        $matriculaDAO->update($matricula);
    }

    /**
     * Como se trata de una tabla intermedia, hay un constraint en tabla_asignatura, por lo que hay que eliminarla primero de ahí para poder permitir borrar la matrícula del alumno
     */
    public function eliminarMatricula($id){
        $pdo = DB::getPdo();
        $matriculaDAO = new MatriculaDAO($pdo);
        $asignaturaMatriculaDAO = new AsignaturaMatriculaDAO($pdo);

        if($asignaturaMatriculaDAO->existsIdMatricula($id)){
            $asignaturaMatriculaDAO->deleteRelacionMatricula($id);
        }

        return $matriculaDAO->delete($id);
    }






}
