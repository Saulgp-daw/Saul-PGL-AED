<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use App\DAO\UsuarioDAO;
use App\DAO\ReservaDAO;
use App\Models\Usuario;
use Throwable;

use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertNotNull;
use function PHPUnit\Framework\assertNull;
use function PHPUnit\Framework\assertTrue;

class UsuarioDAOTest extends TestCase
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

    public function test_find_All(): void {
        $pdo = DB::getPdo();
        $usuarioDAO = new UsuarioDAO($pdo);
        $usuarios = $usuarioDAO->findAll();

        $this->assertTrue(count($usuarios) >= 3);
        $idsEnDB = [123456789, 689088259, 890678456];

        foreach ($idsEnDB as $id) {
            $usuarioCorrecto = $usuarioDAO->findById($id);
            $encontrado = null;
            for($i = 0; $i < count($usuarios) && $encontrado == null; $i++){
                if($usuarios[$i]->getTelefono() == $usuarioCorrecto->getTelefono()){
                    $encontrado = $usuarios[$i];
                }
            }
            $this->assertTrue($encontrado->getTelefono() == $id);
            $usuarioCorrecto = $usuarioDAO->findById($id);
            $this->assertTrue($encontrado->getTelefono() == $usuarioCorrecto->getTelefono());
            $this->assertTrue($encontrado->getNombre() == $usuarioCorrecto->getNombre());
            $this->assertTrue($encontrado->getContrasenha() == $usuarioCorrecto->getContrasenha());
            $this->assertTrue($encontrado->getRol() == $usuarioCorrecto->getRol());
        }
    }

    public function test_find_by_id(): void {
        $pdo = DB::getPdo();
        $usuarioDAO = new UsuarioDAO($pdo);
        $encontrado = $usuarioDAO->findById(123456789);
        assertTrue(isset($encontrado));
        assertTrue($encontrado->getNombre() == "Juan Perez");
        assertFalse($encontrado->getContrasenha() == 4321);
        assertTrue($encontrado instanceof Usuario);

        // Ejemplo dentro de tu test
        //dump(DB::table('reservas')->get());


    }

    public function test_save(): void {
        $pdo = DB::getPdo();
        $usuarioDAO = new UsuarioDAO($pdo);
        $usuario = new Usuario(922342291, "Pepe", "1234");


        try{
            $usuarioGuardado = $usuarioDAO->save($usuario);
        }catch(Throwable $ignored){}

        $grabado = null;

        if(isset($usuarioGuardado)){
            $grabado = $usuarioDAO->findById(922342291);
        }


        assertNotNull($grabado);
        assertTrue($grabado->getNombre() == "Pepe");
        assertTrue($grabado->getContrasenha() == 1234);
        assertTrue($grabado->getRol() == "CLIENTE");

    }

    public function test_actualizar_usuario(){
        $pdo = DB::getPdo();
        $usuarioDAO = new UsuarioDAO($pdo);
        $usuarioEncontrado = $usuarioDAO->findById(689088259);
        $this->assertNotNull($usuarioEncontrado);
        $usuarioEncontrado->setNombre("Juan");
        $usuarioEncontrado->setContrasenha("1234");
        $usuarioEncontrado->setRol("CLIENTE");
        $actualizado = $usuarioDAO->update($usuarioEncontrado);
        $this->assertTrue($actualizado);

        $usuarioActualizado = $usuarioDAO->findById($usuarioEncontrado->getTelefono());

        $this->assertTrue($usuarioActualizado->getNombre() == "Juan");
        $this->assertTrue($usuarioActualizado->getRol() == "CLIENTE");
        $this->assertTrue($usuarioActualizado->getContrasenha() == "1234");
        //dump(DB::table('usuarios')->get());

    }

    //falla porque no puedo borrar un usuario con una foreign key en otra tabla
    public function test_delete_usuario(): void {
        $pdo = DB::getPdo();
        $usuarioDAO = new UsuarioDAO($pdo);
        $reservaDao = new ReservaDAO($pdo);

        $reservasPorTelefonoBorradas = $reservaDao->deleteByTelefono(890678456);
        assertTrue($reservasPorTelefonoBorradas);

        $reservasEncontradas = $reservaDao->findByTelefono(890678456);
        assertTrue(count($reservasEncontradas) == 0);

        $this->assertTrue($usuarioDAO->delete(890678456));
        $encontrado = $usuarioDAO->findById(890678456);
        $this->assertNull($encontrado);
    }

    public function test_find_by_nombre_parcial(): void {
        $pdo = DB::getPdo();
        $usuarioDAO = new UsuarioDAO($pdo);
        $usuarios = $usuarioDAO->findByNombreParcial("ju");
        assertTrue(count($usuarios) > 0);

        foreach ($usuarios as $usuario) {
            $usuarioCorrecto = $usuarioDAO->findById($usuario->getTelefono());
            assertNotNull($usuarioCorrecto);
            assertTrue($usuario->getTelefono() == $usuarioCorrecto->getTelefono() );
            assertTrue($usuario->getTelefono() == $usuarioCorrecto->getTelefono() );
            assertTrue($usuario->getRol() == $usuarioCorrecto->getRol() );
        }



    }




}
