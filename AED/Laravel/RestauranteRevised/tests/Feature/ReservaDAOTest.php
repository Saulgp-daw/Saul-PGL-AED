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
use DateTime;

use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertNotNull;
use function PHPUnit\Framework\assertTrue;


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

    public function test_find_by_id(): void
    {
        $pdo = DB::getPdo();
        $reservaDAO = new ReservaDAO($pdo);
        //dump(DB::table('reservas')->get());
        $encontrado = $reservaDAO->findById(2);
        assertTrue(isset($encontrado));
        assertTrue(123456789 == $encontrado->getTelefono());
        assertTrue(2 == $encontrado->getId_reserva());
        assertTrue(1 == $encontrado->getDuracion());
        //dump($encontrado);
        assertTrue(1672581600 == $encontrado->getFecha_hora());
        assertTrue(1 == $encontrado->getNum_mesa());
        assertTrue("Confirmada" == $encontrado->getEstado());

        $usuarioDAO = new UsuarioDAO($pdo);
        $usuarioEncontrado = $usuarioDAO->findById($encontrado->getTelefono());
        assertNotNull(isset($usuarioEncontrado));
        assertTrue($usuarioEncontrado->getTelefono() == $encontrado->getTelefono());
    }

    public function test_find_All(): void
    {
        $pdo = DB::getPdo();
        $reservaDAO = new ReservaDAO($pdo);
        $reservas = $reservaDAO->findAll();
        $this->assertTrue(count($reservas) >= 4);
        //dump(DB::table('reservas')->get());
        $idsEnDB = [1, 2, 3, 4];

        foreach ($idsEnDB as $id) {
            $reservaCorrecta = $reservaDAO->findById($id);
            $encontrada = null;
            for ($i = 0; $i < count($reservas) && $encontrada == null; $i++) {
                if ($reservas[$i]->getId_reserva() == $reservaCorrecta->getId_reserva()) {
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

    public function test_find_by_telefono(): void
    {
        $pdo = DB::getPdo();
        $reservaDAO = new ReservaDAO($pdo);

        $reservasEncontradas = $reservaDAO->findByTelefono(689088259);

        $this->assertTrue(count($reservasEncontradas) > 0);
    }

    public function test_reserva_solapada(): void{
        $pdo = DB::getPdo();
        $reservaDAO = new ReservaDAO($pdo);
        $reservaNueva = new Reserva(1000, 922442291, strtotime('2023-01-01 12:00:00'), 2, 1, "Sin confirmar");
        $fechaUnix = strtotime('2023-01-01 12:00:00');
        echo "Fecha Unix antes de la inserción: $fechaUnix\n";
        dump(DB::table('reservas')->get());


        $filasAfectadas = $reservaDAO->reservasSeSolapan($reservaNueva);
        var_dump($filasAfectadas);
        assertTrue($filasAfectadas > 0);
    }

    public function test_save(): void
    {
        $pdo = DB::getPdo();
        $reservaDAO = new ReservaDAO($pdo);
        $reserva =  new Reserva(1000, 689088259, strtotime('2023-01-01 12:00:00'), 2, 1, "Sin confirmar");

        try {
            $reservaGuardada = $reservaDAO->save($reserva);
            //var_dump($reservaGuardada);

            //$this->addToAssertionCount(1);

        } catch (Throwable $ignored) {
        }

        $grabado = null;
        //dump(DB::table('reservas')->get());

        assertNotNull(isset($reservaGuardada));

        if (isset($reservaGuardada)) {
            //var_dump($reservaGuardada->getId_reserva());
            $grabado = $reservaDAO->findById(1000);
        }
        $this->assertNotNull($grabado);
        $this->assertTrue($grabado->getTelefono() == $reserva->getTelefono());
        $this->assertTrue($grabado->getDuracion() == $reserva->getDuracion());
        $this->assertTrue($grabado->getFecha_hora() == 1672574400);
    }

    public function test_actualizar_reserva(): void
    {
        $pdo = DB::getPdo();
        $reservaDAO = new ReservaDAO($pdo);
        $reservaEncontrada = $reservaDAO->findById(1);
        $this->assertNotNull($reservaEncontrada);
        $reservaEncontrada->setTelefono(890678456);
        $fechaActual = new DateTime();  // Esto crea un objeto DateTime con la fecha y hora actuales
        $unixTimestampActual = $fechaActual->getTimestamp();
        $reservaEncontrada->setFecha_hora($unixTimestampActual);
        $reservaEncontrada->setDuracion(1);


        $actualizado = $reservaDAO->update($reservaEncontrada);
        $this->assertTrue($actualizado);

        $reservaActualizada = $reservaDAO->findById(1);
        $this->assertTrue($reservaActualizada->getTelefono() == 890678456);
        $this->assertTrue($reservaActualizada->getFecha_hora() == $unixTimestampActual);
        $this->assertTrue($reservaActualizada->getDuracion() == 1);
        //dump(DB::table('reservas')->get());

    }

    public function test_delete_reserva(): void{
        $pdo = DB::getPdo();
        $reservaDAO = new ReservaDAO($pdo);
        $usuarioDAO = new UsuarioDAO($pdo);

        $reservaABorrar = $reservaDAO->findById(2);
        $this->assertNotNull($reservaABorrar);

        $this->assertTrue($reservaDAO->delete($reservaABorrar->getId_reserva()));
        $encontrada = $reservaDAO->findById(2);
        $this->assertNull($encontrada);
    }
}
