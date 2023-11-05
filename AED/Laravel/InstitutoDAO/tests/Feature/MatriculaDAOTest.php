<?php

namespace Tests\Feature;

//use App\Models\AsignaturaDAO;

use App\DAO\AsignaturaMatriculaDAO;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use App\DAO\MatriculaDAO;
use App\Models\Matricula;

use function PHPUnit\Framework\assertTrue;

class MatriculaDAOTest extends TestCase{

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

        $matriculaDAO = new MatriculaDAO($pdo);
        $matriculas = $matriculaDAO->findAll();
        assertTrue(count($matriculas) == 4);
    }

    public function test_borrar_matricula(): void {
        $pdo = DB::getPdo();
        $idMatricula = 1;
        $matriculaDAO = new MatriculaDAO($pdo);
        $asignaturaMatriculaDAO = new AsignaturaMatriculaDAO($pdo);

        $filaRelacionAfectadas = $asignaturaMatriculaDAO->deleteRelacionMatricula($idMatricula);
        $matriculasEliminadas = $matriculaDAO->delete($idMatricula);

        assertTrue($filaRelacionAfectadas >= 1 && $matriculasEliminadas == 1);

    }

    public function test_guardar(): void{
        $pdo = DB::getPdo();

        $matriculaDAO = new MatriculaDAO($pdo);
        $a = new Matricula(0, "78649205S", 2005);
        $matricula = $matriculaDAO->save($a);
        echo $matricula->id;
    }




}

