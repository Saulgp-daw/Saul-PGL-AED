<?php

namespace Tests\Feature;



use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use PDO;
use PDOException;
use Tests\TestCase;
use Throwable;

class EmpleadoDAOCorreccionesTest extends TestCase
{
    public $databaseCreated = false;

    public function setUp(): void
    {
        parent::setUp();

        if (!$this->databaseCreated) {
            $pdo = DB::getPdo();
            require 'CreateDatabase.php';
            $this->databaseCreated = true;
        }
    }


    /**
     * si se pasa el test se garantiza 1 pto en el ejercicio 1 apartado b)
     */
    public function test_1_apartado_B_1pto_findbyid_simple(): void
    {
        $pdo = DB::getPdo();

        $empleadoDAO = new EmpleadoDAO($pdo);

        //buscar empleado sin jefe:
        $empleadoSinJefe = $empleadoDAO->findById(22);

        //Miramos  lo obtenido:
        echo "  -------------------  print_r empleadoSinJefe  ---------------------<br>";
        print_r($empleadoSinJefe);


        $this->assertTrue("Ana" == $empleadoSinJefe->getNombre());
        $this->assertTrue("Pérez Rico" == $empleadoSinJefe->getApellidos());
        $this->assertNull($empleadoSinJefe->jefe);
        $this->assertTrue(5 == $empleadoSinJefe->getNumero());
        $this->assertTrue("San Antonio" == $empleadoSinJefe->getCalle());
        $this->assertTrue("Puerto de la Cruz" == $empleadoSinJefe->getMunicipio());


        //buscar empleado con jefe
        $empleadoConJefe = $empleadoDAO->findById(10);
        $this->assertTrue("Francisco" == $empleadoConJefe->getNombre());
        $this->assertTrue("Álvarez Herrera" == $empleadoConJefe->getApellidos());
        $this->assertTrue(100 == $empleadoConJefe->getNumero());
        $this->assertTrue("Iriarte" == $empleadoConJefe->getCalle());
        $this->assertTrue("Puerto de la Cruz" == $empleadoConJefe->getMunicipio());


    }


    /**
     * si se pasa el test se garantiza 1.5ptos en el ejercicio 1 apartado b)
     */
    public function test_2_apartado_B_1puntoYmedio__findbyid_conjefe(): void
    {
        $pdo = DB::getPdo();

        $empleadoDAO = new EmpleadoDAO($pdo);



        //buscar empleado con jefe
        $empleadoConJefe = $empleadoDAO->findById(10);
        $this->assertTrue("Francisco" == $empleadoConJefe->getNombre());
        $this->assertTrue("Álvarez Herrera" == $empleadoConJefe->getApellidos());
        $this->assertTrue(100 == $empleadoConJefe->getNumero());
        $this->assertTrue("Iriarte" == $empleadoConJefe->getCalle());
        $this->assertTrue("Puerto de la Cruz" == $empleadoConJefe->getMunicipio());

        //este test necesita que  el objeto devuelto sea un empleado
        //con sus datos reales
        //en cualquier otro caso falla
        echo "  -------------------  print_r empleadoConJefe  ---------------------<br>";
        print_r($empleadoConJefe);
        $this->assertTrue($empleadoConJefe->jefe instanceof Empleado);


        $jefePrimerNivel = $empleadoConJefe->jefe;
        $this->assertTrue("Arminda" == $jefePrimerNivel->getNombre());
        $this->assertTrue("García Herrera" == $jefePrimerNivel->getApellidos());
        $this->assertTrue(25 == $jefePrimerNivel->getNumero());
        $this->assertTrue("San Antonio" == $jefePrimerNivel->getCalle());
        $this->assertTrue("La Laguna" == $jefePrimerNivel->getMunicipio());
    }

    /**
     * si se pasa el test se garantiza 2ptos en el ejercicio 1 apartado b)
     */
    public function test_3_apartado_B_2puntos__findbyid_recursivo(): void
    {
        $pdo = DB::getPdo();

        $empleadoDAO = new EmpleadoDAO($pdo);



        //buscar empleado sin jefe:
        $empleadoSinJefe = $empleadoDAO->findById(22);


        $this->assertTrue("Ana" == $empleadoSinJefe->getNombre());
        $this->assertTrue("Pérez Rico" == $empleadoSinJefe->getApellidos());
        $this->assertNull($empleadoSinJefe->jefe);
        $this->assertTrue(5 == $empleadoSinJefe->getNumero());
        $this->assertTrue("San Antonio" == $empleadoSinJefe->getCalle());
        $this->assertTrue("Puerto de la Cruz" == $empleadoSinJefe->getMunicipio());


        //buscar empleado con múltiples jefes
        $empleadoConJefe = $empleadoDAO->findById(10);
        $this->assertTrue("Francisco" == $empleadoConJefe->getNombre());
        $this->assertTrue("Álvarez Herrera" == $empleadoConJefe->getApellidos());
        $this->assertTrue(100 == $empleadoConJefe->getNumero());
        $this->assertTrue("Iriarte" == $empleadoConJefe->getCalle());
        $this->assertTrue("Puerto de la Cruz" == $empleadoConJefe->getMunicipio());

        $this->assertNotNull($empleadoConJefe->jefe);
        $this->assertTrue(25 == $empleadoConJefe->jefe->getId());


        //múltiples jefes. Siguiente nivel:
        $jefePrimerNivel = $empleadoConJefe->jefe;
        $this->assertTrue("Arminda" == $jefePrimerNivel->getNombre());
        $this->assertTrue("García Herrera" == $jefePrimerNivel->getApellidos());
        $this->assertTrue(25 == $jefePrimerNivel->getNumero());
        $this->assertTrue("San Antonio" == $jefePrimerNivel->getCalle());
        $this->assertTrue("La Laguna" == $jefePrimerNivel->getMunicipio());

        $this->assertNotNull($jefePrimerNivel->jefe);
        $this->assertTrue(22 == $jefePrimerNivel->jefe->getId());


        //múltiples jefes. Siguiente nivel:
        $jefeSegundoNivel = $jefePrimerNivel->jefe;
        $this->assertTrue("Ana" == $jefeSegundoNivel->getNombre());
        $this->assertTrue("Pérez Rico" == $jefeSegundoNivel->getApellidos());
        $this->assertTrue(5 == $jefeSegundoNivel->getNumero());
        $this->assertTrue("San Antonio" == $jefeSegundoNivel->getCalle());
        $this->assertTrue("Puerto de la Cruz" == $jefeSegundoNivel->getMunicipio());

        //Ana no tiene jefes:
        $this->assertNull($jefeSegundoNivel->jefe);
    }

    public function test_4_apartado_D_1pto_findAll(): void
    {

        $pdo = DB::getPdo();

        $daoCorrecto = new EmpleadoDAO_ParaCorrecciones();

        $empleadoDAO = new EmpleadoDAO($pdo);
        $empleados = $empleadoDAO->findAll();

        $this->assertTrue(count($empleados) == 5);
        $idsEnDDBB = [10, 14, 15, 22, 25];


        foreach ($idsEnDDBB as $id) {

            $empleadoCorrecto = $daoCorrecto->findById($id);
            $encontrado = null;
            for ($i = 0; $i < count($empleados) && $encontrado == null; $i++) {
                if ($empleados[$i]->getId() == $empleadoCorrecto->getId()) {
                    $encontrado = $empleados[$i];
                }
            }
            $this->assertTrue($encontrado != null);


            $this->assertTrue($encontrado->getId() == $id);

            $empleadoCorrecto = $daoCorrecto->findById($id);
            $this->assertTrue($encontrado->getNombre() == $empleadoCorrecto->getNombre());
            $this->assertTrue($encontrado->getApellidos() == $empleadoCorrecto->getApellidos());
            $this->assertTrue($encontrado->getNumero() == $empleadoCorrecto->getNumero());
            $this->assertTrue($encontrado->getCalle() == $empleadoCorrecto->getCalle());
            $this->assertTrue($encontrado->getMunicipio() == $empleadoCorrecto->getMunicipio());
        }

    }

    public function  test_5_apartado_A_de0pto_a1pto_guardado_con_jefe_nulo(): void
    {
        $pdo = DB::getPdo();

        $daoCorrecto = new EmpleadoDAO_ParaCorrecciones();

        $empleadoDAO = new EmpleadoDAO($pdo);

        $empleadoConJefeNulo = new Empleado();
        $empleadoConJefeNulo->setId(1000);
        $empleadoConJefeNulo->setNombre("PruebaNombre");
        $empleadoConJefeNulo->setApellidos("PruebaApellidos");
        $empleadoConJefeNulo->setFecha_contrato(1234567890123);
        $empleadoConJefeNulo->setjefe(null);
        $empleadoConJefeNulo->setNumero(100);
        $empleadoConJefeNulo->setCalle("PruebaCalle");
        $empleadoConJefeNulo->setMunicipio("PruebaMunicipio");





        try {

            $grabadoSinJefe = $empleadoDAO->save($empleadoConJefeNulo);
        } catch (Throwable $ignored) {
        }

        $grabado = null;


        if (isset($grabadoSinJefe)) {
            $grabado = $daoCorrecto->findById(1000);
        }


        $this->assertNotNull($grabado);
        $this->assertTrue($grabado->getNombre() == "PruebaNombre");
        $this->assertTrue($grabado->getApellidos() == "PruebaApellidos");
        $this->assertTrue($grabado->getFecha_contrato() == 1234567890123);
        $this->assertTrue($grabado->getNumero() == 100);
        $this->assertTrue($grabado->getCalle() == "PruebaCalle");
        $this->assertTrue($grabado->getMunicipio() == "PruebaMunicipio");
    }





    public function  test_6_apartado_A_de1pto_a2pto_guardado_con_jefe_ok(): void
    {
        $pdo = DB::getPdo();

        $daoCorrecto = new EmpleadoDAO_ParaCorrecciones();

        $empleadoDAO = new EmpleadoDAO($pdo);


        $empleadoConJefeReal = new Empleado();
        $empleadoConJefeReal->setId(3000);
        $empleadoConJefeReal->setNombre("PruebaNombre");
        $empleadoConJefeReal->setApellidos("PruebaApellidos");
        $empleadoConJefeReal->setFecha_contrato(1234567890123);

        $jefeAnaReal = $daoCorrecto->findById(22);

        $empleadoConJefeReal->setjefe($jefeAnaReal);
        $empleadoConJefeReal->setNumero(100);
        $empleadoConJefeReal->setCalle("PruebaCalle");
        $empleadoConJefeReal->setMunicipio("PruebaMunicipio");




        $grabado = null;
        try {
            $grabadoConJefe = $empleadoDAO->save($empleadoConJefeReal);
        } catch (Throwable $ignored) {
        }


        $grabado = $daoCorrecto->findById(3000);
        $this->assertNotNull($grabado);


        $this->assertTrue($grabado->getNombre() == "PruebaNombre");
        $this->assertTrue($grabado->getApellidos() == "PruebaApellidos");
        $this->assertTrue($grabado->getFecha_contrato() == 1234567890123);
        $this->assertTrue($grabado->getNumero() == 100);
        $this->assertTrue($grabado->getCalle() == "PruebaCalle");
        $this->assertTrue($grabado->getMunicipio() == "PruebaMunicipio");

        $this->assertTrue($grabado->getjefe()->getId() == "22");
    }




    public function  test_7_apartado_C_1pto_deleteById(): void{
        $pdo = DB::getPdo();

        $empleadoDAO = new EmpleadoDAO($pdo);


        $this->assertTrue($empleadoDAO->deleteById(15));

        $daoCorrecto = new EmpleadoDAO_ParaCorrecciones();

        $encontrado = $daoCorrecto->findById(15);
        $this->assertNull($encontrado);

    }

}


class EmpleadoDAO_ParaCorrecciones
{

    private $pdo;

    public function __construct()
    {
        $this->pdo = DB::getPdo();
    }


    public function findById($id)
    {

        $sql = "SELECT * FROM empleados WHERE id = :id";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':id' => $id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $empleado = new Empleado();
                $empleado->setId($row["id"]);
                $empleado->setNombre($row["nombre"]);
                $empleado->setApellidos($row["apellidos"]);
                $empleado->setFecha_contrato($row["fecha_contrato"]);
                $empleado->setNumero($row["numero"]);
                $empleado->setCalle($row["calle"]);
                $empleado->setMunicipio($row["municipio"]);


                if ($row["jefe"] != null) {
                    $empleado->setJefe($this->findById($row["jefe"]));
                }
                return $empleado;
            } else {
                return null;
            }
        } catch (Exception $ex) {
            return null;
        }
    }
}
