<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;
use Illuminate\Support\Facades\DB;
use App\DAO\AlumnoDAO;
use App\DAO\PersonaDAO;

class AlumnoController extends Controller
{

    public function obtenerAlumnos(){
        $pdo = DB::getPdo();
        $alumnoDAO = new AlumnoDAO($pdo);
        $alumnos = $alumnoDAO->findAll();
        foreach ($alumnos as $alumno) {
           echo $alumno->nombre. " ".$alumno->apellidos. " ". $alumno->dni . " ".
           date("d/m/Y", $alumno->fechaNacimiento). "</br>";
        }
    }

    public function guardarAlumno(){
        $alumno = new Alumno("78649205S", "Saul", "González Pérez", strtotime("07/29/1996"));
        $pdo = DB::getPdo();
        $alumnoDAO = new AlumnoDAO($pdo);
        $alumnoDAO->save($alumno);
    }

    public function buscarPorDni($dni){
        $pdo = DB::getPdo();
        $alumnoDAO = new AlumnoDAO($pdo);
        $alumno = $alumnoDAO->findById($dni);

        if($alumno){
            echo "Alumno encontrado: ". $alumno->nombre. " ".$alumno->apellidos. " ". $alumno->dni . " ".
            date("d/m/Y", $alumno->fechaNacimiento);
        }
    }

    public function actualizarAlumno(){
        $alumno = new Alumno("78649205S", "Benito", "Jiménez", strtotime("07/29/1996"));
        $pdo = DB::getPdo();
        $alumnoDAO = new AlumnoDAO($pdo);
        $alumnoDAO->update($alumno);
    }

    public function eliminarAlumno($dni){
        $pdo = DB::getPdo();
        $alumnoDAO = new AlumnoDAO($pdo);
        $alumnoDAO->delete($dni);
    }






}
