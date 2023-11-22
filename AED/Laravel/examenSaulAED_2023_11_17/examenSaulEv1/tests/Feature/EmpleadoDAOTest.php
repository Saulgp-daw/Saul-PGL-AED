<?php

namespace Tests\Feature;
use App\Models\Empleado;
use App\DAO\EmpleadoDAO;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\assertTrue;
/***
 * @Author saúl
 */


class EmpleadoDAOTest extends TestCase
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

        $empleadoDAO = new EmpleadoDAO($pdo);
        $empleados = $empleadoDAO->findAll();
        assertTrue(count($empleados) > 0);
    }

    public function test_2_save(){
        $pdo = DB::getPdo();
        $empleadoDAO = new EmpleadoDAO($pdo);
        $nuevo = new Empleado(30,"Pepe", "Velázquez", 1541876400000, 25, 69, "Dos Patos", "Adeje");
        $creado = $empleadoDAO->save($nuevo);

        //var_dump($creado);
        assertTrue(isset($creado->id));
    }

    public function test_3_findById(){
        $pdo = DB::getPdo();
        $empleadoDAO = new EmpleadoDAO($pdo);
        $encontrado = $empleadoDAO->findById(10);
        assertTrue(isset($encontrado)  && (10 == $encontrado->getId() ));
        $jefe = $encontrado->getJefe();

        //25 es el id del jefe del empleado encontrado, reemplazar con el id correspondiente
        $idJefe = 25;
        assertTrue(isset($jefe) && ($idJefe == $jefe->getId()));
    }

    public function test_4_deleteById(){
        $pdo = DB::getPdo();
        $empleadoDAO = new EmpleadoDAO($pdo);
        $empleado = $empleadoDAO->findById(10);
        $jefeEliminado = $empleadoDAO->delete($empleado->getJefe()->getId());
        assertTrue(count($jefeEliminado) == 1);
        $empleadoEliminado = $empleadoDAO->delete($empleado->getId());
        assertTrue($empleadoDAO->findById(10) == null);
    }

    
}
