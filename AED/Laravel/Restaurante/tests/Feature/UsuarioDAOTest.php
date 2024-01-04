<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use App\DAO\UsuarioDAO;
use App\Models\Usuario;
use Throwable;

use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertNotNull;
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

    public function test_find_by_id(): void {
        $pdo = DB::getPdo();
        $usuarioDAO = new UsuarioDAO($pdo);
        $encontrado = $usuarioDAO->findById(123456789);
        assertTrue(isset($encontrado));
        assertTrue($encontrado->getNombre() == "Juan Perez");
        assertFalse($encontrado->getContrasenha() == 4321);
        assertTrue($encontrado instanceof Usuario);

        // Ejemplo dentro de tu test
        dump(DB::table('reservas')->get());


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

    
}
