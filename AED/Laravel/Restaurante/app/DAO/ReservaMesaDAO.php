<?php

namespace App\DAO;

use App\Contracts\UsuarioContract;
use App\Contracts\ReservaMesaContract;
use App\Contracts\MesaContract;
use App\Contracts\ReservaContract;
use App\DAO\Crud;
use App\Models\Reserva;
use App\Models\Mesa;
use Exception;
use PDO;
use \Datetime;

class ReservaMesaDAO 
{

    private $myPDO;

    public function __construct($pdo)
    {
        $this->myPDO = $pdo;
    }

    function save($dao)
    {
    }

    function findById($id)
    {
        $reservaEncontrada = null;
        $sql = "SELECT * FROM " . ReservaMesaContract::TABLE_NAME . " WHERE " . ReservaMesaContract::COL_ID . "= :id";

        $stmt = $this->myPDO->prepare($sql);
        $stmt->execute([
            ':id' => $id
        ]);

        if ($row = $stmt->fetch()) {
            $reserva = new Reserva();
            $reserva->setId_reserva($row[ReservaContract::COL_ID]);
            $reserva->setTelefono($row[ReservaContract::COL_TEL]);
            $reserva->setFecha_hora(new Datetime($row[ReservaContract::COL_DATE]));
            $reserva->setDuracion($row[ReservaContract::COL_DURATION]);
            $reservaEncontrada = $reserva;
        }

        return $reservaEncontrada;
    }

    function update($dao)
    {
    }

    function delete($id)
    {
    }
}
