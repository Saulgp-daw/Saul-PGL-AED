<?php

namespace App\DAO;

use App\Contracts\AsignaturaContract;
use App\Contracts\MatriculaContract;
use App\DAO\Crud;
use App\Models\Asignatura;
use Exception;
use PDO;

class AsignaturaDAO implements Crud
{

    private static $tabla = AsignaturaContract::TABLE_NAME;
    private static $colId = AsignaturaContract::COL_ID;
    private static $colNombre = AsignaturaContract::COL_NOMBRE;
    private static $colCurso = AsignaturaContract::COL_CURSO;

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
        $asignaturas = [];
        while ($row = $stmt->fetch()) {
            $id = $row[self::$colId];
            $nombre = $row[self::$colNombre];
            $curso = $row[self::$colCurso];
            $asignatura = new Asignatura($id, $nombre, $curso);
            $asignaturas[] = $asignatura;
        }
        return $asignaturas;
    }

    function save($asignatura)
    {
        $sql = "INSERT INTO " . self::$tabla . " (" . self::$colId . ", " . self::$colNombre . ", " . self::$colCurso . ")
        VALUES (:id, :nombre, :curso)";

        try {
            $this->myPDO->beginTransaction();
            $stmt = $this->myPDO->prepare($sql);
            $stmt->execute(
                [
                    ':id' => $asignatura->id,
                    ':nombre' => $asignatura->nombre,
                    ":curso" => $asignatura->curso
                ]
            );
            //si filasAfectadas > 0 => hubo éxito consulta
            $filasAfectadas = $stmt->rowCount();
            //echo "Filas afectadas: $filasAfectadas";

            if ($filasAfectadas > 0) {
                $asignaturaCreada = new Asignatura($this->myPDO->lastInsertId(), $asignatura->nombre, $asignatura->curso);
                $this->myPDO->commit();
            }
        } catch (Exception $ex) {
            echo "ha habido una excepción se lanza rollback automático: $ex";
            $this->myPDO->rollback();
        }
        $stmt = null;

        //Echo "Último id generado: ".$this->myPDO->lastInsertId();


        //echo "Estoy en asignatura dao ". $this->myPDO->lastInsertId(). " ";
        return $asignaturaCreada ?? null;
    }

    function findById($id)
    {
        $asignaturaEncontrada = null;
        $sql = "SELECT * FROM " . self::$tabla . " WHERE :id = " . self::$colId;
        $stmt = $this->myPDO->prepare($sql);
        $stmt->execute(
            [
                ':id' => $id
            ]
        );

        if ($row = $stmt->fetch()) {
            $asignatura = new Asignatura();
            $asignatura->id = $row[self::$colId];
            $asignatura->nombre = $row[self::$colNombre];
            $asignatura->curso = $row[self::$colCurso];
            $asignaturaEncontrada = $asignatura;
        }

        return $asignaturaEncontrada;
    }


    function findByCurso($curso){
        $stmt = $this->myPDO->prepare("SELECT * FROM " . self::$tabla ." WHERE :curso = ".self::$colCurso);
        $stmt->setFetchMode(PDO::FETCH_ASSOC); //devuelve array asociativo
        $stmt->execute(
            [
                ':curso' => $curso
            ]
        ); // Ejecutamos la sentencia
        $asignaturas = [];
        while ($row = $stmt->fetch()) {
            $id = $row[self::$colId];
            $nombre = $row[self::$colNombre];
            $curso = $row[self::$colCurso];
            $matricula = new Asignatura($id, $nombre, $curso);
            $asignaturas[] = $matricula;
        }
        return $asignaturas;
    }



    function update($asignatura)
    {
        $sql = "UPDATE ". self::$tabla. " SET ". self::$colNombre. " = :nombre, ".self::$colCurso. " = :curso WHERE ".self::$colId . " = :id";

        try{
            $this->myPDO->beginTransaction();
            $stmt = $this->myPDO->prepare($sql);
            $stmt->execute(
                [
                    ':id' => $asignatura->id,
                    ':nombre' => $asignatura->nombre,
                    ":curso" => $asignatura->curso
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
        $filasAfectadas = 0;
        try{
            $this->myPDO->beginTransaction();
            $stmt = $this->myPDO->prepare($sql);
            $stmt->execute(
                [
                    ':id' => $id
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
        return $filasAfectadas;
    }
}
