<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use App\DAO\AlumnoDAO;
use App\DAO\AsignaturaMatriculaDAO;
use App\DAO\MatriculaDAO;
use App\Models\Alumno;

use function PHPUnit\Framework\assertTrue;

class AlumnoDAOTest extends TestCase
{
    public  $databaseCreated = false;

    public  function setUp(): void{
        parent::setUp();

        if(! $this->databaseCreated ){
            $pdo = DB::getPdo();
            require 'CreateDatabase.php';
            $this->databaseCreated = true;
        }
    }


    public function test_1_findAll(): void {
        $pdo = DB::getPdo();

        $alumnoDAO = new AlumnoDAO($pdo);
        $alumnos = $alumnoDAO->findAll();
        assertTrue(count($alumnos) == 3);
    }

    public function test_2_save(): void {
        $pdo = DB::getPdo();

        $alumnoDAO = new AlumnoDAO($pdo);
        $a = new Alumno("78649205S", "Saul", "Gonzalez", 19960729);


        $alumno = $alumnoDAO->save($a);
        $alumnos = $alumnoDAO->findAll();
        assertTrue(count($alumnos) == 4);
        assertTrue(isset($alumno->dni )  && $alumno->dni != "");
    }


    public function test_3_findbyid(): void {
        $pdo = DB::getPdo();

        $alumnoDAO = new AlumnoDAO($pdo);
        //$a = new Asignatura(0, "unaasignatura", "uncurso");
        //$a->nombre = "unaasignatura";
        //$a->curso = "uncurso";

        //$asignatura = $asignaturaDAO->save($a);
        $obtenido = $alumnoDAO->findById("87654321X");
        echo $obtenido->dni;

        assertTrue(isset($obtenido)  && ("87654321X" == $obtenido->dni ));
    }

    public function test_4_deletebyDni(): void{
        $pdo = DB::getPdo();
        $dni = "87654321X";
        $alumnoDAO = new AlumnoDAO($pdo);
        $matriculaDAO = new MatriculaDAO($pdo);
        $asignaturaMatriculaDAO = new AsignaturaMatriculaDAO($pdo);

        $matriculasAlumno = $matriculaDAO->findByDni($dni);

        foreach ($matriculasAlumno as $matricula) {
            $asignaturaMatriculaDAO->deleteRelacionMatricula($matricula->id);
        }

        $matriculasEliminadas = $matriculaDAO->deleteByDni($dni);
        $alumnosEliminados = $alumnoDAO->delete($dni);
        assertTrue($alumnosEliminados == 1 && $matriculasEliminadas >= 1); //da error porque debe de borrarse de la relacional primero
    }
}
