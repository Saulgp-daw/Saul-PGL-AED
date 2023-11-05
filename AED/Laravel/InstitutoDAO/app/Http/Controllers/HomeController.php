<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\AsignaturaMatriculaController;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\AsignaturaController;

class HomeController extends Controller
{
    public static function index()
    {
        return self::home();
    }

    public static function home()
    {

        return view("home");
    }

    public static function gestionarAlumnosView($mensaje = "")
    {
        $alumnoController = new AlumnoController();
        $alumnos = $alumnoController->obtenerAlumnos();
        return view("gestionAlumnos", compact("mensaje", "alumnos"));
    }

    public function gestionarMatriculasView()
    {
        return view("gestionAlumnos");
    }

    public function gestionarAsignaturasView()
    {
        return view("gestionAlumnos");
    }

    public function agregarAlumno(Request $request)
    {
        $dni = $request->input("dni");
        $nombre = $request->input("nombre");
        $apellidos = $request->input("apellidos") ?? "";
        $fechaNacimiento = $request->input("fechanacimiento");

        //echo $dni." ".$nombre." ".$apellidos. " ".$fechaNacimiento;

        $alumnoController = new AlumnoController();
        $alumno = $alumnoController->guardarAlumno($dni, $nombre, $apellidos, $fechaNacimiento);
        $mensaje = "Hubo un error a la hora de crear el alumno";
        if ($alumno != null) {
            $mensaje = "Alumno creado correctamente";
        }

        return self::gestionarAlumnosView($mensaje);
    }

    public function borrarAlumno(Request $request)
    {
        $dni = $request->input("dni");
        $alumnoController = new AlumnoController();
        $matriculaController = new MatriculaController();

        $matriculasAlumno = $matriculaController->buscarPorDni($dni);

        foreach ($matriculasAlumno as $matricula) {
            $matriculaController->eliminarMatricula($matricula->id);
        }

        $filasAfectadas = $alumnoController->eliminarAlumno($dni);
        $mensaje = "No se pudo borrar a este alumno";
        if ($filasAfectadas == 1) {
            $mensaje = "alumno borrado con éxito";
        }

        return self::gestionarAlumnosView($mensaje);
    }

    public function actualizarAlumno(Request $request)
    {
        $dni = $request->input("dni");
        $nombre = $request->input("nombre");
        $apellidos = $request->input("apellidos") ?? "";
        $fechaNacimiento = $request->input("fechanacimiento");
        //echo $dni." ".$nombre." ".$apellidos. " ".$fechaNacimiento;
        $alumnoController = new AlumnoController();
        $filasAfectadas = $alumnoController->actualizarAlumno($dni, $nombre, $apellidos, $fechaNacimiento);
        $mensaje = "No se pudo editar a este alumno";
        if ($filasAfectadas == 1) {
            $mensaje = "alumno editado con éxito";
        }
        return self::gestionarAlumnosView($mensaje);
    }

    public function buscarAlumno(Request $request)
    {
        $dni = $request->input('dni');
        $nombre = $request->input('nombre');
        $alumnoController = new AlumnoController();
        $mensaje = "Alumno no encontrado";
        $alumno = null;
        $alumnos = null;
        if ($dni) {
            // Realiza la búsqueda por DNI
            $alumno = $alumnoController->buscarPorDni($dni);
        } elseif ($nombre) {
            // Realiza la búsqueda por nombre
            $alumnos = $alumnoController->buscarPorNombre($nombre);
        } else {
            $mensaje = "Debes escribir en al menos uno de los dos input";
        }

        if ($alumno != null) {
            $mensaje = "Alumno encontrado: " . $alumno->nombre . " " . $alumno->apellidos . " " . $alumno->dni . " " .
                date("d/m/Y", $alumno->fechaNacimiento);
        }

        if($alumnos != null){
            $mensaje = "";

            // print_r($alumnos);
            // die();
            foreach ($alumnos as $alumno) {
                $mensaje .= "Alumno encontrado: " . $alumno->nombre . " " . $alumno->apellidos . " " . $alumno->dni . " " .
                date("d/m/Y", $alumno->fechaNacimiento)." <br>";
            }
        }


        return self::gestionarAlumnosView($mensaje);
    }
}
