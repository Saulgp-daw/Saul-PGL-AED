<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matricula;
use Illuminate\Support\Facades\DB;
use App\DAO\MatriculaDAO;

class MatriculaController extends Controller
{

    public function obtenerMatriculas(){
        $pdo = DB::getPdo();
        $matriculaDAO = new MatriculaDAO($pdo);
        $matriculas = $matriculaDAO->findAll();
        foreach ($matriculas as $matricula) {
           echo $matricula->id. " ".$matricula->dni. " ". $matricula->year. " </br>";
        }
    }

    public function guardarMatricula(){
        $matricula = new Matricula(5, "12312312K", 2006);
        $pdo = DB::getPdo();
        $matriculaDAO = new MatriculaDAO($pdo);
        $matriculaDAO->save($matricula);
    }

    public function buscarPorId($id){
        $pdo = DB::getPdo();
        $matriculaDAO = new MatriculaDAO($pdo);
        $matricula = $matriculaDAO->findById($id);

        if($matricula){
            echo "Matricula encontrado: ". $matricula->id. " ".$matricula->dni. " ". $matricula->year;
        }
    }

    public function buscarPorDni($dni){
        $pdo = DB::getPdo();
        $matriculaDAO = new MatriculaDAO($pdo);
        $matriculas = $matriculaDAO->findByDni($dni); //la relación es N a 1, un alumno puede tener varias matrículas

        foreach ($matriculas as $matricula) {
            echo $matricula->id. " ".$matricula->dni. " ". $matricula->year. " </br>";
         }
    }

    public function actualizarMatricula(){
        $matricula = new Matricula(5, "12345678Z", 2023);
        $pdo = DB::getPdo();
        $matriculaDAO = new MatriculaDAO($pdo);
        $matriculaDAO->update($matricula);
    }

    public function eliminarMatricula($id){
        $pdo = DB::getPdo();
        $matriculaDAO = new MatriculaDAO($pdo);
        $matriculaDAO->delete($id);
    }






}
