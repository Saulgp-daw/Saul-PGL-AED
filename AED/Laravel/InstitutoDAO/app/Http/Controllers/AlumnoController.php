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
        // foreach ($alumnos as $alumno) {
        //    echo $alumno->nombre. " ".$alumno->apellidos. " ". $alumno->dni . " ".
        //    date("d/m/Y", $alumno->fechaNacimiento). "</br>";
        // }

        return $alumnos;
    }

    public function guardarAlumno($dni, $nombre, $apellidos, $fechaNacimiento){
        $pdo = DB::getPdo();
        $alumnoDAO = new AlumnoDAO($pdo);
        if(strtotime($fechaNacimiento) == ""){
            $fechaNacimiento = 0;
        }else{
            $fechaNacimiento = strtotime($fechaNacimiento);
        }
        $alumno = $alumnoDAO->save(new Alumno($dni, $nombre, $apellidos, $fechaNacimiento));
        return $alumno;
    }

    public function buscarPorDni($dni){
        $pdo = DB::getPdo();
        $alumnoDAO = new AlumnoDAO($pdo);
        $alumno = $alumnoDAO->findById($dni);

        // if($alumno){
        //     echo "Alumno encontrado: ". $alumno->nombre. " ".$alumno->apellidos. " ". $alumno->dni . " ".
        //     date("d/m/Y", $alumno->fechaNacimiento);
        // }

        return $alumno;
    }

    public function buscarPorNombre($nombre){
        $pdo = DB::getPdo();
        $alumnoDAO = new AlumnoDAO($pdo);
        return $alumnoDAO->findByName($nombre);

        // if($alumno){
        //     echo "Alumno encontrado: ". $alumno->nombre. " ".$alumno->apellidos. " ". $alumno->dni . " ".
        //     date("d/m/Y", $alumno->fechaNacimiento);
        // }


    }

    public function actualizarAlumno($dni, $nombre, $apellidos, $fechaNacimiento){
        //$alumno = new Alumno("78649205S", "Benito", "Jiménez", strtotime("07/29/1996"));
        $pdo = DB::getPdo();
        $alumnoDAO = new AlumnoDAO($pdo);
        $fechaNacimiento = $this->establecerFecha($fechaNacimiento);
        return $alumnoDAO->update(new Alumno($dni, $nombre, $apellidos, $fechaNacimiento));
    }

    public function eliminarAlumno($dni){
        $pdo = DB::getPdo();
        $alumnoDAO = new AlumnoDAO($pdo);
        return $alumnoDAO->delete($dni);
    }

    public function establecerFecha($fechaNacimiento){
        if(strtotime($fechaNacimiento) == ""){
            $fechaNacimiento = 0;
        }else{
            $fechaNacimiento = strtotime($fechaNacimiento);
        }
        return $fechaNacimiento;
    }






}
