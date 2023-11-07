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
        if(session()->has('usuario')){
            return view("home");
        }else{
            return redirect("/");
        }
    }

    public static function gestionarAlumnosView($mensaje = "")
    {
        if(!session()->has('usuario')){
            return redirect("/");
        }
        $alumnoController = new AlumnoController();
        $alumnos = $alumnoController->obtenerAlumnos();
        return view("gestionAlumnos", compact("mensaje", "alumnos"));
    }

    public static function gestionarMatriculasView($mensaje = "")
    {
        if(!session()->has('usuario')){
            return redirect("/");
        }
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

        return view("gestionMatriculas", compact("mensaje", "matriculas", "alumnos", "datos", "asignaturas"));
    }

    public static function gestionarAsignaturasView($mensaje = "")
    {
        if(!session()->has('usuario')){
            return redirect("/");
        }
        $asignaturaController = new AsignaturaController();
        $asignaturas = $asignaturaController->obtenerAsignaturas();

        $asignaturasUnicas = [];

        foreach ($asignaturas as $asignatura) {
            if (!in_array($asignatura->curso, $asignaturasUnicas)) {
                $asignaturasUnicas[] = $asignatura->curso;
            }
        }
        // print_r($asignaturasUnicas);
        // die();


        return view("gestionAsignaturas", compact("asignaturas", "mensaje", "asignaturasUnicas"));
    }

    /**
     * ALUMNOS
     */
    public function agregarAlumno(Request $request)
    {
        $dni = $request->input("dni");
        $nombre = $request->input("nombre");
        $apellidos = $request->input("apellidos") ?? "";
        $fechaNacimiento = $request->input("fechanacimiento");

        //echo $dni." ".$nombre." ".$apellidos. " ".$fechaNacimiento;
        $mensaje = "Hubo un error a la hora de crear el alumno";
        $alumnoController = new AlumnoController();
        if($alumnoController->buscarPorDni($dni) == null){
            $alumno = $alumnoController->guardarAlumno($dni, $nombre, $apellidos, $fechaNacimiento);
            $mensaje = "Alumno creado correctamente";
        }else{
            $mensaje = "Este alumno con ese DNI ya existe";
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
            $mensaje .= "<br>".$matricula->id. " - ".$matricula->dni. " - ".$matricula->year;
        }
        return self::gestionarMatriculasView($mensaje);
    }

    /**
     * ASIGNATURAS
     */

    public function agregarAsignatura(Request $request){
        $nombre = $request->input("nombre");
        $curso =  $request->input("curso");
        $asignaturaController = new AsignaturaController();
        $mensaje = "Hubo un error a la hora de crear la asignatura. El nombre ya existe";
        $asignatura = null;
        if(!$asignaturaController->comprobarExiste($nombre)){
            $asignatura = $asignaturaController->guardarAsignatura($nombre, $curso);
        }


        if($asignatura != null){
            $mensaje = "Asignatura creada correctamente";
        }

        return self::gestionarAsignaturasView($mensaje);
    }

    public function borrarAsignatura(Request $request){
        $id = $request->input("id");

        // echo $id;
        // die();
        $asignaturaController = new AsignaturaController();
        $mensaje = "Hubo un error a la hora de borrar la asignatura";
        $filasAfectadas = $asignaturaController->eliminarAsignatura($id);

        if($filasAfectadas >= 1){
            $mensaje = "Éxito. Asignatura borrada";
        }

        return self::gestionarAsignaturasView($mensaje);

    }

    public function editarAsignatura(Request $request){
        $id = $request->input("id");
        $nombre = $request->input("nombre");
        $curso = $request->input("curso");
        $asignaturaController = new AsignaturaController();
        $filasAfectadas = $asignaturaController->actualizarAsignatura($id, $nombre, $curso);
        $mensaje = "Error. No se puedo editar la asignatura";

        if($filasAfectadas >= 1){
            $mensaje = "Éxito. La asignatura ha sido modificada";
        }

        return self::gestionarAsignaturasView($mensaje);
    }

    public function buscarAsignatura(Request $request){
        $curso = $request->input("curso");
        // echo $curso;
        // die();

        $asignaturaController = new AsignaturaController();
        $asignaturas = $asignaturaController->buscarPorCurso($curso);

        $mensaje = "Asignaturas de $curso: ";
        foreach ($asignaturas as $asignatura) {
            $mensaje .= "<br>".$asignatura->id. " ".$asignatura->nombre." ".$asignatura->curso;
        }

        return self::gestionarAsignaturasView($mensaje);
    }


}
