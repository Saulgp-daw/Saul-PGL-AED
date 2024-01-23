<?php

namespace App\DAO;

use App\Contracts\UsuarioContract;
use App\Contracts\ReservaMesaContract;
use App\Contracts\ReservaContract;
use App\DAO\Crud;
use App\Models\Reserva;
use Exception;
use PDO;
use \Datetime;


class ReservaDAO implements Crud
{

    private $myPDO;

    public function __construct($pdo)
    {
        $this->myPDO = $pdo;
    }

    public function findAll()
    {
        $stmt = $this->myPDO->prepare("SELECT * FROM " . ReservaContract::TABLE_NAME);
        $stmt->setFetchMode(PDO::FETCH_ASSOC); //devuelve array asociativo
        $stmt->execute(); // Ejecutamos la sentencia
        $reservas = [];
        while ($row = $stmt->fetch()) {
            $id_reserva = $row[ReservaContract::COL_ID];
            $telefono = $row[ReservaContract::COL_TEL];
            $fecha_hora = $row[ReservaContract::COL_DATE];
            $duracion = $row[ReservaContract::COL_DURATION];
            $reserva = new Reserva($id_reserva, $telefono, new Datetime($fecha_hora), $duracion);
            $reservas[] = $reserva;
        }
        return $reservas;
    }



    public function findById($id)
    {
        $reservaEncontrada = null;
        $sql = "SELECT * FROM " . ReservaContract::TABLE_NAME . " WHERE " . ReservaContract::COL_ID . "= :id";

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

    public function save($dao)
    {
        $sql = "INSERT INTO " . ReservaContract::TABLE_NAME . " (" .
           ReservaContract::COL_ID . ", " .
            ReservaContract::COL_TEL . ", " .
            ReservaContract::COL_DATE . ", " .
            ReservaContract::COL_DURATION .
            ") VALUES (:id_reserva,  :telefono, :fecha_hora, :duracion)";

        try {
            $this->myPDO->beginTransaction();
            $stmt = $this->myPDO->prepare($sql);
            $stmt->execute(
                [
                    ":id_reserva" => $dao->getId_reserva(),
                    ":telefono" => $dao->getTelefono(),
                    ":fecha_hora" => $dao->getFecha_hora()->format('Y-m-d H:i:s'),
                    ":duracion" => $dao->getDuracion()
                ]
            );
            $filasAfectadas = $stmt->rowCount();
            echo "Filas afectadas: $filasAfectadas";

            if ($filasAfectadas > 0) {
                $this->myPDO->commit();
                $reserva = new Reserva($this->myPDO->lastInsertId(), $dao->getTelefono(), $dao->getFecha_hora(), $dao->getDuracion());
            }
        } catch (Exception $ex) {
            echo "ha habido una excepción se lanza rollback automático: $ex";
            $this->myPDO->rollback();
        }
        $stmt = null;

        return $reserva ?? null;
    }

    public function update($dao)
    {
    }

    public function delete($id)
    {
    }
}
