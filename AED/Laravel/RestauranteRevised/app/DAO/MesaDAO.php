<?php

namespace App\DAO;

use App\Contracts\MesaContract;
use App\Contracts\UsuarioContract;
use App\DAO\Crud;
use App\Models\Mesa;
use Exception;
use PDO;

class MesaDAO
{
    private $myPDO;

    public function __construct($pdo)
    {
        $this->myPDO = $pdo;
    }

    public function findById($id){
        $mesaEncontrada = null;
        //SELECT * FROM `usuarios` WHERE telefono=123456789
        $sql = "SELECT * FROM " . MesaContract::TABLE_NAME . " WHERE " . MesaContract::COL_NUMBER . " = :num_mesa";

        $stmt = $this->myPDO->prepare($sql);
        $stmt->execute(
            [
                ':num_mesa' => $id
            ]
        );

        if ($row = $stmt->fetch()) {
            $mesa = new Mesa();
            $mesa->setNum_mesa($row[MesaContract::COL_NUMBER]);
            $mesa->setSillas($row[MesaContract::COL_SEATS]);
            $mesaEncontrada = $mesa;
        }

        return $mesaEncontrada;
    }

    public function findAll(){
        $sql = "SELECT * FROM ". MesaContract::TABLE_NAME;
        $stmt = $this->myPDO->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC); //devuelve array asociativo
        $stmt->execute(); // Ejecutamos la sentencia
        $mesas = [];
        while ($row = $stmt->fetch()) {

            $num_mesa = $row[MesaContract::COL_NUMBER];
            $sillas = $row[MesaContract::COL_SEATS];
            $mesa = new Mesa($num_mesa, $sillas);
            $mesas[] = $mesa;

        }
        return $mesas;
    }

    public function findMesasPorSilla($sillas){
        //SELECT * FROM `mesas` WHERE sillas = 4
        $sql = "SELECT * FROM ". MesaContract::TABLE_NAME. " WHERE ". MesaContract::COL_SEATS. " = :sillas";
        $stmt = $this->myPDO->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC); //devuelve array asociativo
        $stmt->execute([
            ":sillas" => $sillas
        ]); // Ejecutamos la sentencia
        $mesas = [];
        while ($row = $stmt->fetch()) {

            $num_mesa = $row[MesaContract::COL_NUMBER];
            $sillas = $row[MesaContract::COL_SEATS];
            $mesa = new Mesa($num_mesa, $sillas);
            $mesas[] = $mesa;

        }
        return $mesas;
    }
}
