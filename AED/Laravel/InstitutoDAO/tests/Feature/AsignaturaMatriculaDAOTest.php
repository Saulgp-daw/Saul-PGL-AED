<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use App\DAO\AsignaturaMatriculaDAO;
use function PHPUnit\Framework\assertTrue;

class AsignaturaMatriculaDAOTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public  $databaseCreated = false;

    public  function setUp(): void{
        parent::setUp();

        if(! $this->databaseCreated ){
            $pdo = DB::getPdo();
            require 'CreateDatabase.php';
            $this->databaseCreated = true;
        }
    }

    public function test_Relacion_crear(): void {
        $pdo = DB::getPdo();

        $relacionDAO = new AsignaturaMatriculaDAO($pdo);
        $filasAfectadas = $relacionDAO->assignRelacionMatriculaAsignatura(4,1);
        assertTrue($filasAfectadas == 1);
    }

    public function test_Relacion_borrar_Matricula(): void{
        $pdo = DB::getPdo();

        $relacionDAO = new AsignaturaMatriculaDAO($pdo);
        $filasAfectadas = $relacionDAO->deleteRelacionMatricula(1);
        assertTrue($filasAfectadas >= 1);
    }

    public function test_Relacion_borrar_Asignatura(): void{
        $pdo = DB::getPdo();

        $relacionDAO = new AsignaturaMatriculaDAO($pdo);
        $filasAfectadas = $relacionDAO->deleteRelacionAsignatura(7);
        assertTrue($filasAfectadas >= 1);
    }

    public function test_encontrar_matriculas_pasando_id_asignatura(): void{
        $pdo = DB::getPdo();

        $relacionDAO = new AsignaturaMatriculaDAO($pdo);
        $filasAfectadas = $relacionDAO->findMatriculasByAsignaturaId(7);
        assertTrue(count($filasAfectadas) >= 1);
    }

    public function test_encontrar_asignaturas_pasando_id_matricula(): void{
        $pdo = DB::getPdo();

        $relacionDAO = new AsignaturaMatriculaDAO($pdo);
        $filasAfectadas = $relacionDAO->findAsignaturasByMatriculaId(1);
        assertTrue(count($filasAfectadas) >= 1);
    }

    public function test_buscar_year_nombre():void{
        $pdo = DB::getPdo();

        $relacionDAO = new AsignaturaMatriculaDAO($pdo);
        $relacionDAO->buscarAlumnoConAsignaturaPorYearYNombre("BAE", 2021);
    }




}
