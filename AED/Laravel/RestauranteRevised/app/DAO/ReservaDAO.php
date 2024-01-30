<?php

namespace App\DAO;

use App\Contracts\UsuarioContract;
use App\Contracts\MesaContract;
use App\Contracts\ReservaContract;
use App\DAO\Crud;
use App\Models\Reserva;
use App\Models\Mesa;
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
            $num_mesa = $row[ReservaContract::COL_NUM_TABLE];
            $estado = $row[ReservaContract::COL_STATE];
            $reserva = new Reserva($id_reserva, $telefono, $fecha_hora, $duracion, $num_mesa, $estado);
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
            $reserva->setFecha_hora($row[ReservaContract::COL_DATE]);
            $reserva->setDuracion($row[ReservaContract::COL_DURATION]);
            $reserva->setNum_mesa($row[ReservaContract::COL_NUM_TABLE]);
            $reserva->setEstado($row[ReservaContract::COL_STATE]);
            $reservaEncontrada = $reserva;
        }

        return $reservaEncontrada;
    }

    public function findByTelefono($telefono){
        $stmt = $this->myPDO->prepare("SELECT * FROM " . ReservaContract::TABLE_NAME. " WHERE :telefono = ". ReservaContract::COL_TEL);
        $stmt->setFetchMode(PDO::FETCH_ASSOC); //devuelve array asociativo
        $stmt->execute([
            ":telefono" => $telefono
        ]);
        $reservas = [];
        while ($row = $stmt->fetch()) {
            $id_reserva = $row[ReservaContract::COL_ID];
            $telefono = $row[ReservaContract::COL_TEL];
            $fecha_hora = $row[ReservaContract::COL_DATE];
            $duracion = $row[ReservaContract::COL_DURATION];
            $num_mesa = $row[ReservaContract::COL_NUM_TABLE];
            $estado = $row[ReservaContract::COL_STATE];
            $reserva = new Reserva($id_reserva, $telefono, $fecha_hora, $duracion, $num_mesa, $estado);
            $reservas[] = $reserva;
        }
        return $reservas;
    }

    public function reservasSeSolapan(Reserva $dao)
    {
        //         SELECT COUNT(*) FROM reservas AS r
        // WHERE
        //     '2023-01-01 09:00:00' < DATE_ADD(r.fecha_hora, INTERVAL r.duracion HOUR)
        //     AND DATE_ADD('2023-01-01 09:00:00', INTERVAL 3 HOUR) > r.fecha_hora
        //     AND r.num_mesa = 1;

        //         SELECT * FROM reservas AS r
        // WHERE
        //     '1706608800' < r.fecha_hora + r.duracion * 3600
        //     AND r.fecha_hora < '1706608800' + 3 * 3600
        //     AND r.num_mesa = 1;


        // $sql = "SELECT COUNT(*) FROM " . ReservaContract::TABLE_NAME
        //     . " WHERE "
        //     . ":fecha_hora1 < DATE_ADD(" . ReservaContract::COL_DATE . ", INTERVAL " . ReservaContract::COL_DURATION . " HOUR) "
        //     . "AND DATE_ADD( :fecha_hora2, INTERVAL :duracion HOUR) > " . ReservaContract::COL_DATE
        //     . " AND " . ReservaContract::COL_NUM_TABLE . " = :num_mesa";

            $sql = "SELECT COUNT(*) FROM ". ReservaContract::TABLE_NAME
            . " WHERE "
            . " 1672574400 < ". ReservaContract::COL_DATE . " + ". ReservaContract::COL_DURATION. " * 3600"
            . " AND ". ReservaContract::COL_DATE . " < 1672574400 + 3 * 3600"
            . " AND ". ReservaContract::COL_NUM_TABLE. " = 1;";

            echo "Consulta SQL: $sql\n";


            $stmt = $this->myPDO->prepare($sql);
            $stmt->execute([
                // ':fecha_hora1' => $dao->getFecha_hora(),
                // ':fecha_hora2' => $dao->getFecha_hora(),
                // ':duracion' => $dao->getDuracion(),
                // ':num_mesa' => $dao->getNum_mesa()
            ]);

            $filasAfectadas = $stmt->rowCount();
            //echo "Filas afectadas: $filasAfectadas";


        return $filasAfectadas ?? 0;
    }

    public function save($dao)
    {
        $sql = "INSERT INTO " . ReservaContract::TABLE_NAME . " (" .
            ReservaContract::COL_ID . ", " .
            ReservaContract::COL_TEL . ", " .
            ReservaContract::COL_DATE . ", " .
            ReservaContract::COL_DURATION . ", " .
            ReservaContract::COL_NUM_TABLE . ", " .
            ReservaContract::COL_STATE .

            ") VALUES (:id_reserva, :telefono, :fecha_hora, :duracion, :num_mesa, :estado)";


        try {
            $this->myPDO->beginTransaction();
            $stmt = $this->myPDO->prepare($sql);
            $stmt->execute(
                [
                    ":id_reserva" => $dao->getId_reserva(),
                    ":telefono" => $dao->getTelefono(),
                    ":fecha_hora" => $dao->getFecha_hora(),
                    ":duracion" => $dao->getDuracion(),
                    ":num_mesa" => $dao->getNum_mesa(),
                    ":estado" => $dao->getEstado()
                ]
            );
            $filasAfectadas = $stmt->rowCount();
            //echo "Filas afectadas: $filasAfectadas";

            if ($filasAfectadas > 0) {
                $ultimoIdInsertado = $this->myPDO->lastInsertId();
                $this->myPDO->commit();

                $reserva = new Reserva($ultimoIdInsertado, $dao->getTelefono(), $dao->getFecha_hora(), $dao->getDuracion(), $dao->getNum_mesa(), $dao->getEstado());
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
        $sql = "UPDATE " . ReservaContract::TABLE_NAME .
            " SET " . ReservaContract::COL_TEL . " = :telefono, "
            . ReservaContract::COL_DATE . " = :fecha_hora, "
            . ReservaContract::COL_NUM_TABLE . " = :num_mesa, "
            . ReservaContract::COL_STATE . " = :estado, "
            . ReservaContract::COL_DURATION . " = :duracion WHERE " . ReservaContract::COL_ID . " = :id";

        $actualizado = false;
        try {
            $this->myPDO->beginTransaction();
            $stmt = $this->myPDO->prepare($sql);
            $stmt->execute([
                ':telefono' => $dao->getTelefono(),
                ':fecha_hora' => $dao->getFecha_hora(),
                ':duracion' => $dao->getDuracion(),
                ":num_mesa" => $dao->getNum_mesa(),
                ":estado" => $dao->getEstado(),
                ':id' => $dao->getId_reserva()
            ]);

            $filasAfectadas = $stmt->rowCount();

            if ($filasAfectadas > 0) {
                $actualizado = true;
                $this->myPDO->commit();
            }
        } catch (Exception $ex) {
            echo "ha habido una excepción se lanza rollback automático: $ex";
            $this->myPDO->rollback();
        }

        $stmt = null;
        return $actualizado;
    }

    public function delete($id)
    {
        $sql = "DELETE FROM " . ReservaContract::TABLE_NAME .
            " WHERE "
            . ReservaContract::COL_ID . " = :id";

        try {
            $this->myPDO->beginTransaction();
            $stmt = $this->myPDO->prepare($sql);
            $stmt->execute(
                [
                    ':id' => $id
                ]
            );
            $filasAfectadas = $stmt->rowCount();

            if ($filasAfectadas > 0) {
                $this->myPDO->commit();
                $borrado = true;
            }
        } catch (Exception $ex) {
            echo "ha habido una excepción se lanza rollback automático: $ex";
            $this->myPDO->rollback();
        }
        $stmt = null;

        return $borrado ?? false;
    }
}
