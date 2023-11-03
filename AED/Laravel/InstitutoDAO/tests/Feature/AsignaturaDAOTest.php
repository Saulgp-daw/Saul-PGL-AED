<?php

namespace Tests\Feature;

//use App\Models\AsignaturaDAO;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use App\DAO\AsignaturaDAO;
use App\Models\Asignatura;

use function PHPUnit\Framework\assertTrue;

class AsignaturaDAOTest extends TestCase{

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

        $asignaturaDAO = new AsignaturaDAO($pdo);
        $asignaturas = $asignaturaDAO->findAll();
        assertTrue(count($asignaturas) == 8);
    }

    public function test_2_save(): void {
        $pdo = DB::getPdo();

        $asignaturaDAO = new AsignaturaDAO($pdo);
        $a = new Asignatura(0, "unaasignatura", "uncurso");
        //$a->nombre = "unaasignatura";
        //$a->curso = "uncurso";

        $asignatura = $asignaturaDAO->save($a);
        $asignaturas = $asignaturaDAO->findAll();
        assertTrue(count($asignaturas) == 9);
        assertTrue(isset($asignatura->id ) && $asignatura->id > 0 );
    }


    public function test_3_findbyid(): void {
        $pdo = DB::getPdo();

        $asignaturaDAO = new AsignaturaDAO($pdo);
        //$a = new Asignatura(0, "unaasignatura", "uncurso");
        //$a->nombre = "unaasignatura";
        //$a->curso = "uncurso";

        //$asignatura = $asignaturaDAO->save($a);
        $obtenido = $asignaturaDAO->findById(1);


        assertTrue(isset($obtenido) && (1 == $obtenido->id ) );
    }
}

