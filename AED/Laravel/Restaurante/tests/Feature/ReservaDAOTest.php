<?php

namespace Tests\Feature;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use App\DAO\ReservaDAO;
use App\DAO\UsuarioDAO;
use App\Models\Reserva;
use Throwable;

use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertNotNull;
use function PHPUnit\Framework\assertTrue;

use \Datetime;

class ReservaDAOTest extends TestCase
{
    public  $databaseCreated = false;

    public  function setUp(): void
    {
        parent::setUp();

        if (!$this->databaseCreated) {
            $pdo = DB::getPdo();
            require 'CreateDatabase.php';
            $this->databaseCreated = true;
        }
    }

    public function test_find_by_id(): void {
        $pdo = DB::getPdo();
        $reservaDAO = new ReservaDAO($pdo);
        $encontrado = $reservaDAO->findById(2);
        assertTrue(isset($encontrado));
        assertTrue(123456789 == $encontrado->getTelefono());
        assertTrue(2 == $encontrado->getId_reserva());
        assertTrue(1 == $encontrado->getDuracion());
        assertTrue(new Datetime("2023-01-01 14:00:00") == $encontrado->getFecha_hora());

        $usuarioDAO = new UsuarioDAO($pdo);
        $usuarioEncontrado = $usuarioDAO->findById($encontrado->getTelefono());
        assertNotNull(isset($usuarioEncontrado));
        assertTrue($usuarioEncontrado->getTelefono() == $encontrado->getTelefono());


    }

    public function test_find_All(): void{
        $pdo = DB::getPdo();
        $reservaDAO = new ReservaDAO($pdo);
        $reservas = $reservaDAO->findAll();
        $this->assertTrue(count($reservas) >= 4);
        //dump(DB::table('reservas')->get());
        $idsEnDB = [1, 2, 3, 4];

        foreach($idsEnDB as $id){
            $reservaCorrecta = $reservaDAO->findById($id);
            $encontrada = null;
            for($i = 0; $i < count($reservas) && $encontrada == null; $i++){
                if($reservas[$i]->getId_reserva() == $reservaCorrecta->getId_reserva()){
                    $encontrada = $reservas[$i];
                }
            }
            $this->assertTrue($encontrada->getId_reserva() == $id);
            $reservaCorrecta = $reservaDAO->findById($id);
            $this->assertTrue($encontrada->getId_reserva() == $reservaCorrecta->getId_reserva());
            $this->assertTrue($encontrada->getTelefono() == $reservaCorrecta->getTelefono());
            $this->assertTrue($encontrada->getFecha_hora() == $reservaCorrecta->getFecha_hora());
            $this->assertTrue($encontrada->getDuracion() == $reservaCorrecta->getDuracion());

        }
    }

    public function test_save(): void {
        $pdo = DB::getPdo();
        $reservaDAO = new ReservaDAO($pdo);
        $fechaHora = new DateTime();
        $reserva = new Reserva( 1000, 689088259, $fechaHora, 3);

        try{
            $reservaGuardada = $reservaDAO->save($reserva);
            //var_dump($reservaGuardada->getFecha_hora());

            //$this->addToAssertionCount(1);

        }catch(Throwable $ignored){
        }

        $grabado = null;
        dump(DB::table('reservas')->get());

        assertNotNull(isset($reservaGuardada));

        if(isset($reservaGuardada)){
            $grabado = $reservaDAO->findById(1000);
        }
        $this->assertNotNull($grabado);
        $this->assertTrue($grabado->getTelefono() == 689088259);
        $this->assertTrue($grabado->getDuracion() == 3);
        $this->assertTrue($grabado->getFecha_hora()->format('Y-m-d H:i:s') == $fechaHora->format('Y-m-d H:i:s'));

    }
}
