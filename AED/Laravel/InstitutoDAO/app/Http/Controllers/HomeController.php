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

    public static function gestionarMatriculasView($mensaje = "")
    {
        $matriculaController = new MatriculaController();
        $alumnoController = new AlumnoController();
        $asignaturaController = new AsignaturaController();
        $asignaturaMatriculaController = new AsignaturaMatriculaController();

        $matriculas = $matriculaController->obtenerMatriculas();
        $alumnos = $alumnoController->obtenerAlumnos();
        $asignaturas = $asignaturaController->obtenerAsignaturas();

        $datos = [];
        foreach ($matriculas as $matricula) {
            $datos[$matricula->id] = $asignaturaMatriculaController->devolverAsignaturasDeMatricula($matricula->id);
        }

        // foreach ($datos as $key => $asignaturas) {
        //    echo $key;
        //    foreach ($asignaturas as $asignatura) {
        //         echo $asignatura->nombre;
        //    }
        // }
        // die();

        return view("gestionMatriculas", compact("mensaje", "matriculas", "alumnos", "datos", "asignaturas"));
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

        if ($alumnos != null) {
            $mensaje = "";

            // print_r($alumnos);
            // die();
            foreach ($alumnos as $alumno) {
                $mensaje .= "Alumno encontrado: " . $alumno->nombre . " " . $alumno->apellidos . " " . $alumno->dni . " " .
                    date("d/m/Y", $alumno->fechaNacimiento) . " <br>";
            }
        }

        return self::gestionarAlumnosView($mensaje);
    }

    /**
     * Matriculas
     */

    public function agregarMatricula(Request $request)
    {
        $dni = $request->input("dni");
        $year = $request->input("year");
        $asignaturas = $request->input('asignaturas', []); //esto convierte los checkbox en un array con los values

        // echo $dni. " ".$year." <br>";
        // print_r($asignaturas);

        $matriculaController = new MatriculaController();
        $asignaturaMatriculaController = new AsignaturaMatriculaController();
        $mensaje = "Ha habido un error a la hora de agregar una matrícula";
        if (is_numeric($year) && !empty($asignaturas)) {
            $filasAfectadas = 0;
            $matricula = $matriculaController->guardarMatricula(0, $dni, $year);
            if ($matricula != null) {
                $mensaje = "Matrícula sin asignaturas relacionadas agregada correctamente";

                foreach ($asignaturas as $id) {
                    $filasAfectadas = $asignaturaMatriculaController->asignarRelacionMatriculaAsignatura($matricula->id, $id);
                }
                if ($filasAfectadas) {
                    $mensaje = "Todo ha ido correctamente. Se añadió una matrícula con asignaturas";
                }
            }
        }

        return self::gestionarMatriculasView($mensaje);
    }

    public function borrarMatricula(Request $request)
    {
        $id = $request->input("id");
        $matriculaController = new MatriculaController();
        $filasAfectadas = $matriculaController->eliminarMatricula($id);

        $mensaje = "Hubo un error a la hora de borrar la matrícula";
        if ($filasAfectadas >= 1) {
            $mensaje = "Matrícula borrada con éxito";
        }
        return self::gestionarMatriculasView($mensaje);
    }

    public function editarMatricula(Request $request)
    {
        $idMatricula = $request->input("idMatricula");
        $dni = $request->input("dni");
        $year =  $request->input("year");
        $asignaturas = $request->input('asignaturas', []);
        $matriculaController = new MatriculaController();
        $asignaturaMatriculaController = new AsignaturaMatriculaController();

        $mensaje = "Ha habido un error a la hora de editar la matrícula";
        if (!empty($asignaturas) && is_numeric($year)) {
            $filasAfectadas = $matriculaController->eliminarMatricula($idMatricula);
            if ($filasAfectadas >= 1) {
                $matricula = $matriculaController->guardarMatricula(0, $dni, $year);
                if ($matricula != null) {
                    foreach ($asignaturas as $id) {
                        $filasRelacion = $asignaturaMatriculaController->asignarRelacionMatriculaAsignatura($matricula->id, $id);
                    }
                    if ($filasRelacion) {
                        $mensaje = "Todo ha ido correctamente. Se ha editado la matrícula";
                    }
                }
            }
        }
        return self::gestionarMatriculasView($mensaje);
    }

    public function buscarMatricula(Request $request){
        $dni = $request->input("dni");
        $year =  $request->input("year");
        $opcion = $request->input('opcion');
        $matriculaController = new MatriculaController();
        $mensaje = "";

        if($opcion == "dni"){
            $matriculas = $matriculaController->buscarPorDni($dni);
            $mensaje = "-- Las matrículas con el DNI: $dni son --";
        }else{
            $matriculas = $matriculaController->buscarPorAnho($year);
            $mensaje = "-- Las matrículas del año: $year son -- ";
        }

        foreach ($matriculas as $matricula) {
            $mensaje .= "<br>".$matricula->id. " ".$matricula->dni. " ".$matricula->year;
        }
        return self::gestionarMatriculasView($mensaje);
    }


}
