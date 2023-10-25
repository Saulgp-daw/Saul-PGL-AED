<?php

namespace App\DAO;

use App\Contracts\PersonaContract;
use App\DAO\Crud;
use App\Models\Persona;
use Exception;
use PDO;

class PersonaDAO implements Crud
{
    private $myPDO;
    public function __construct($pdo)
    {
        $this->myPDO = $pdo;
    }

    public function findAll()
    {
        // FETCH_ASSOC
        $stmt = $this->myPDO->prepare("SELECT * FROM " . PersonaContract::TABLE_NAME);
        $stmt->setFetchMode(PDO::FETCH_ASSOC); //devuelve array asociativo
        $stmt->execute(); // Ejecutamos la sentencia
        $personas = [];
        while ($row = $stmt->fetch()) {
            $p = new Persona();
            $p->id = $row["id"];
            $p->nombre = $row["nombre"];
            $p->edad = $row["edad"];
            $personas[] = $p;
        }
        return $personas;
    }

    function save($p)
    {
        $tablename = PersonaContract::TABLE_NAME;
        $colid = PersonaContract::COL_ID;
        $coledad = PersonaContract::COL_EDAD;
        $colnombre = PersonaContract::COL_NOMBRE;
        $sql = "INSERT INTO $tablename ($colid, $colnombre, $coledad)
        VALUES(:id,:nombre, :edad)";
        try {
            $this->myPDO->beginTransaction();
            $stmt = $this->myPDO->prepare($sql);
            $stmt->execute(
                [
                    ':id' => $p->id,
                    ':nombre' => $p->nombre,
                    ":edad" => $p->edad
                ]
            );
            //si filasAfectadas > 0 => hubo éxito consulta
            $filasAfectadas = $stmt->rowCount();
            echo "<br>afectadas: " . $filasAfectadas;
            $stmt->execute([
                ':id' => null,
                ':nombre' => "ani" . rand(2000, 3000),
                ":edad" => rand(18, 100)
            ]);
            //obtenemos el id generado con:
            $idgenerado = $this->myPDO->lastInsertId();
            //forzamos un rollback aleatorio para ver que deshace los cambios
            if ($idgenerado > rand(0, 300)) {
                echo "aleatorio pequeño. Forzamos un rollback";
                $this->myPDO->rollback();
            } else {
                $this->myPDO->commit();
            }
        } catch (Exception $ex) {
            echo "ha habido una excepción se lanza rollback automático";
        }
        $stmt = null;
    }


    function findById($id)
    {
        $personaDevuelta = null;
        $tablename = PersonaContract::TABLE_NAME;
        $colid = PersonaContract::COL_ID;
        $sql = "SELECT * FROM $tablename WHERE $colid = :id";
        try{
            $this->myPDO->beginTransaction();
            $stmt = $this->myPDO->prepare($sql);
            $stmt->execute(
                [
                    ':id' => $id
                ]
            );
            if ($row = $stmt->fetch()) {
                $p = new Persona();
                $p->id = $row["id"];
                $p->nombre = $row["nombre"];
                $p->edad = $row["edad"];
                $personaDevuelta = $p;
            }

            $filasAfectadas = $stmt->rowCount();
            echo "<br>afectadas: " . $filasAfectadas. "<br>";
            if ($filasAfectadas > 0) {
                $this->myPDO->commit();
            }else{
                $this->myPDO->rollback();
            }

        }catch(Exception $ex) {
            echo "<br>ha habido una excepción se lanza rollback automático<br>";
        }
        $stmt = null;
        return $personaDevuelta;
    }

    function update($persona)
    {

    }

    function delete($id)
    {
    }
}
