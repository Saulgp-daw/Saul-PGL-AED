<?php

namespace App\DAO;

use App\Contracts\AsignaturaContract;
use App\Contracts\MatriculaContract;
use App\Contracts\AsignaturaMatriculaContract;
use App\DAO\Crud;
use App\Models\Matricula;
use App\Models\Asignatura;
use Exception;
use PDO;

class MatriculaDAO implements Crud {

    private static $tabla = MatriculaContract::TABLE_NAME;
    private static $colId = MatriculaContract::COL_ID;
    private static $colDni = MatriculaContract::COL_DNI;
    private static $colYear = MatriculaContract::COL_YEAR;

    private $myPDO;
    public function __construct($pdo)
    {
        $this->myPDO = $pdo;
    }

    function findAll()
    {
        $stmt = $this->myPDO->prepare("SELECT * FROM " . self::$tabla);
        $stmt->setFetchMode(PDO::FETCH_ASSOC); //devuelve array asociativo
        $stmt->execute(); // Ejecutamos la sentencia
        $matriculas = [];
        while ($row = $stmt->fetch()) {


            $id = $row[self::$colId];
            $dni = $row[self::$colDni];
            $year = $row[self::$colYear];
            $matricula = new Matricula($id, $dni, $year);
            $matriculas[] = $matricula;
        }
        return $matriculas;
    }

    function save($matricula)
    {
        $sql = "INSERT INTO " . self::$tabla . " (" . self::$colId . ", " . self::$colDni . ", " . self::$colYear . ") VALUES (:id, :dni, :year)";

        try {
            $this->myPDO->beginTransaction();
            $stmt = $this->myPDO->prepare($sql);
            $stmt->execute(
                [
                    ':id' => $matricula->id,
                    ':dni' => $matricula->dni,
                    ":year" => $matricula->year
                ]
            );
            //si filasAfectadas > 0 => hubo éxito consulta
            $filasAfectadas = $stmt->rowCount();
            echo "Filas afectadas: $filasAfectadas";

            if ($filasAfectadas > 0) {
                $this->myPDO->commit();
            }
        } catch (Exception $ex) {
            echo "ha habido una excepción se lanza rollback automático: $ex";
            $this->myPDO->rollback();
        }
        $stmt = null;
    }

    function findById($id)
    {
        $matriculaEncontrado = null;
        $sql = "SELECT * FROM " . self::$tabla . " WHERE :id = " . self::$colId;
        $stmt = $this->myPDO->prepare($sql);
        $stmt->execute(
            [
                ':id' => $id
            ]
        );

        if ($row = $stmt->fetch()) {
            $matricula = new Matricula();
            $matricula->id = $row[self::$colId];
            $matricula->dni = $row[self::$colDni];
            $matricula->year = $row[self::$colYear];
            $matriculaEncontrado = $matricula;
        }

        return $matriculaEncontrado;

    }



    function update($matricula)
    {
        $sql = "UPDATE ". self::$tabla. " SET ". self::$colDni. " = :dni, ".self::$colYear. " = :year WHERE ".self::$colId . " = :id";

        try{
            $this->myPDO->beginTransaction();
            $stmt = $this->myPDO->prepare($sql);
            $stmt->execute(
                [
                    ':id' => $matricula->id,
                    ':dni' => $matricula->dni,
                    ":year" => $matricula->year
                ]
            );
            $filasAfectadas = $stmt->rowCount();
            echo "Filas afectadas: $filasAfectadas";

            if ($filasAfectadas > 0) {
                $this->myPDO->commit();
            }
        }catch(Exception $ex){
            echo "ha habido una excepción se lanza rollback automático: $ex";
            $this->myPDO->rollback();
        }
        $stmt = null;
    }

    function delete($id)
    {
        $sql = "DELETE FROM ".self::$tabla. " WHERE :id = ".self::$colId;
        try{
            $this->myPDO->beginTransaction();
            $stmt = $this->myPDO->prepare($sql);
            $stmt->execute(
                [
                    ':id' => $id
                ]
            );
            $filasAfectadas = $stmt->rowCount();
            echo "TABLA Matricula: Filas afectadas: $filasAfectadas </br>";

            if ($filasAfectadas > 0) {
                $this->myPDO->commit();
            }
        }catch(Exception $ex){
            echo "ha habido una excepción se lanza rollback automático: $ex";
            $this->myPDO->rollback();
        }
        $stmt = null;
    }

    function findByDni($dni){
        $stmt = $this->myPDO->prepare("SELECT * FROM " . self::$tabla ." WHERE :dni = ".self::$colDni);
        $stmt->setFetchMode(PDO::FETCH_ASSOC); //devuelve array asociativo
        $stmt->execute(
            [
                ':dni' => $dni
            ]
        ); // Ejecutamos la sentencia
        $matriculas = [];
        while ($row = $stmt->fetch()) {
            $id = $row[self::$colId];
            $dni = $row[self::$colDni];
            $year = $row[self::$colYear];
            $matricula = new Matricula($id, $dni, $year);
            $matriculas[] = $matricula;
        }
        return $matriculas;
    }
}
