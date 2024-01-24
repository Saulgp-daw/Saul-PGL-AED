<?php

namespace Tests\Feature;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use App\DAO\ReservaDAO;
use App\DAO\UsuarioDAO;
use App\Models\Reserva;
use App\Models\Mesa;
use Throwable;

use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertNotNull;
use function PHPUnit\Framework\assertTrue;

use \Datetime;

class ReservaDAOTest extends TestCase
{
    public  $databaseCreated = false;

//    public  function setUp(): void
//     {
//         parent::setUp();

//         if (!$this->databaseCreated) {
//             $pdo = DB::getPdo();
//             require 'CreateDatabase.php';
//             $this->databaseCreated = true;
//         }
//     }

    // public function test_find_by_id(): void {
    //     $pdo = DB::getPdo();
    //     $reservaDAO = new ReservaDAO($pdo);
    //     //dump(DB::table('reservas')->get());
    //     $encontrado = $reservaDAO->findById(2);
    //     assertTrue(isset($encontrado));
    //     assertTrue(123456789 == $encontrado->getTelefono());
    //     assertTrue(2 == $encontrado->getId_reserva());
    //     assertTrue(1 == $encontrado->getDuracion());
    //     //dump($encontrado);
    //     assertTrue(new Datetime("2023-01-01 14:00:00") == $encontrado->getFecha_hora());
    //     assertTrue(1 == $encontrado->getNum_mesa());
    //     assertTrue("Confirmada" == $encontrado->getEstado());

    //     $usuarioDAO = new UsuarioDAO($pdo);
    //     $usuarioEncontrado = $usuarioDAO->findById($encontrado->getTelefono());
    //     assertNotNull(isset($usuarioEncontrado));
    //     assertTrue($usuarioEncontrado->getTelefono() == $encontrado->getTelefono());


    // }

    // public function test_find_All(): void{
    //     $pdo = DB::getPdo();
    //     $reservaDAO = new ReservaDAO($pdo);
    //     $reservas = $reservaDAO->findAll();
    //     $this->assertTrue(count($reservas) >= 4);
    //     //dump(DB::table('reservas')->get());
    //     $idsEnDB = [1, 2, 3, 4];

    //     foreach($idsEnDB as $id){
    //         $reservaCorrecta = $reservaDAO->findById($id);
    //         $encontrada = null;
    //         for($i = 0; $i < count($reservas) && $encontrada == null; $i++){
    //             if($reservas[$i]->getId_reserva() == $reservaCorrecta->getId_reserva()){
    //                 $encontrada = $reservas[$i];
    //             }
    //         }
    //         $this->assertTrue($encontrada->getId_reserva() == $id);
    //         $reservaCorrecta = $reservaDAO->findById($id);
    //         $this->assertTrue($encontrada->getId_reserva() == $reservaCorrecta->getId_reserva());
    //         $this->assertTrue($encontrada->getTelefono() == $reservaCorrecta->getTelefono());
    //         $this->assertTrue($encontrada->getFecha_hora() == $reservaCorrecta->getFecha_hora());
    //         $this->assertTrue($encontrada->getDuracion() == $reservaCorrecta->getDuracion());

    //     }
    // }

    public function test_reserva_solapada(): void{
        $pdo = DB::getPdo();
        $reservaDAO = new ReservaDAO($pdo);
        $reservaNueva = new Reserva(1000, 922442291, new Datetime('2023-01-01 12:00:00'), 2, 1, "Sin confirmar");
        

        $filasAfectadas = $reservaDAO->reservasSeSolapan($reservaNueva);
        //var_dump($filasAfectadas);
        assertTrue($filasAfectadas > 0);
    }

    public function test_save(): void {
        $pdo = DB::getPdo();
        $reservaDAO = new ReservaDAO($pdo);
        $fechaHora = new DateTime();
        $reserva =  new Reserva(1000, 922442291, new Datetime('2023-01-01 12:00:00'), 2, 1, "Sin confirmar");

        try{
            $reservaGuardada = $reservaDAO->save($reserva);
            var_dump($reservaGuardada);

            //$this->addToAssertionCount(1);

        }catch(Throwable $ignored){
        }

        $grabado = null;
        //dump(DB::table('reservas')->get());

        assertNotNull(isset($reservaGuardada));

        if(isset($reservaGuardada)){
            $grabado = $reservaDAO->findById($reservaGuardada->getId_reserva());
        }
        $this->assertNotNull($grabado);
        $this->assertTrue($grabado->getTelefono() == 689088259);
        $this->assertTrue($grabado->getDuracion() == 3);
        $this->assertTrue($grabado->getFecha_hora()->format('Y-m-d H:i:s') == $fechaHora->format('Y-m-d H:i:s'));

    }

    public function test_actualizar_reserva(): void{
        $pdo = DB::getPdo();
        $reservaDAO = new ReservaDAO($pdo);
        $reservaEncontrada = $reservaDAO->findById(13);
        $this->assertNotNull($reservaEncontrada);
        $reservaEncontrada->setTelefono(890678456);
        $fechaHora = new Datetime();
        $reservaEncontrada->setFecha_hora($fechaHora);
        $reservaEncontrada->setDuracion(1);


        $actualizado = $reservaDAO->update($reservaEncontrada);
        $this->assertTrue($actualizado);

        $reservaActualizada = $reservaDAO->findById(13);
        $this->assertTrue($reservaActualizada->getTelefono() == 890678456);
        $this->assertTrue($reservaActualizada->getFecha_hora()->format('Y-m-d H:i:s') == $fechaHora->format('Y-m-d H:i:s'));
        $this->assertTrue($reservaActualizada->getDuracion() == 1);
        //dump(DB::table('reservas')->get());

    }

    // public function test_delete_reserva(): void{
    //     $pdo = DB::getPdo();
    //     $reservaDAO = new ReservaDAO($pdo);
    //     $usuarioDAO = new UsuarioDAO($pdo);

    //     $reservaABorrar = $reservaDAO->findById(12);
    //     $this->assertNotNull($reservaABorrar);
        
    //     $this->assertTrue($reservaDAO->delete($reservaABorrar->getId_reserva()));
    //     $encontrada = $reservaDAO->findById(1);
    //     $this->assertNull($encontrada);
    // }
}
