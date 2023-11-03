<?php

namespace Tests\Feature;

//use App\Models\AsignaturaDAO;
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

        $asignaturaDAO = new MatriculaDAO($pdo);
        $asignaturas = $asignaturaDAO->findAll();
        assertTrue(count($asignaturas) == 4);
    }


}

