<?php

namespace Tests\Feature;

use App\DAO\MesaDAO;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

use function PHPUnit\Framework\assertTrue;

class MesaDAOTest extends TestCase
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

    public function test_find_mesas_por_silla():void{
        $pdo = DB::getPdo();

        $mesasDao = new MesaDAO($pdo);
        $mesas = $mesasDao->findMesasPorSilla(4);

        assertTrue(count($mesas) > 0);
        foreach($mesas as $mesa){
            $mesaCorrecta = $mesasDao->findById($mesa->getNum_mesa());
            assertTrue($mesaCorrecta->getNum_mesa() == $mesa->getNum_mesa());
            assertTrue($mesaCorrecta->getSillas() == $mesa->getSillas());
        }

    }
}
