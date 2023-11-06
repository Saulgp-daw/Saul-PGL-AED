<?php

namespace App\DAO;

use App\Contracts\AsignaturaContract;
use App\Contracts\MatriculaContract;
use App\Contracts\AsignaturaMatriculaContract;
use App\DAO\Crud;
use App\Models\Asignatura;
use App\Models\Matricula;
use Exception;
use PDO;

class AsignaturaMatriculaDAO
{

    private static $tabla = AsignaturaMatriculaContract::TABLE_NAME;
    private static $colId = AsignaturaMatriculaContract::COL_ID;
    private static $colIdAsignatura = AsignaturaMatriculaContract::COL_IDASIGNATURA;
    private static $colIdMatricula = AsignaturaMatriculaContract::COL_IDMATRICULA;
    //Asignatura
    private static $tablaAsignatura = AsignaturaContract::TABLE_NAME;
    private static $idAsignatura = AsignaturaContract::COL_ID;
    private static $nombreAsignatura = AsignaturaContract::COL_NOMBRE;
    private static $cursoAsignatura = AsignaturaContract::COL_CURSO;
    //Matricula
    private static $tablaMatricula = MatriculaContract::TABLE_NAME;
    private static $idMatricula = MatriculaContract::COL_ID;
    private static $dniMatricula = MatriculaContract::COL_DNI;
    private static $yearMatricula = MatriculaContract::COL_YEAR;


    private $myPDO;
    public function __construct($pdo)
    {
        $this->myPDO = $pdo;
    }

    function assignRelacionMatriculaAsignatura($idMatricula, $idAsignatura)
    {
        //INSERT INTO `asignatura_matricula`(`id`, `idmatricula`, `idasignatura`) VALUES ('[value-1]','[value-2]','[value-3]')
        $sql = "INSERT INTO " . self::$tabla . " (" . self::$colId . ", " . self::$colIdMatricula . ", " . self::$colIdAsignatura . ")
        VALUES (:id, :idmatricula, :idasignatura)";
        $filasAfectadas = 0;
        try {
            $this->myPDO->beginTransaction();
            $stmt = $this->myPDO->prepare($sql);
            $stmt->execute([
                ':id' => 0,
                ':idmatricula' => $idMatricula,
                ':idasignatura' => $idAsignatura
            ]);
            $filasAfectadas = $stmt->rowCount();
            //echo "Filas afectadas: $filasAfectadas";
            if ($filasAfectadas > 0) {
                $this->myPDO->commit();
            }
        } catch (Exception $ex) {
            echo "ha habido una excepción se lanza rollback automático: $ex";
            $this->myPDO->rollback();
        }
        $stmt = null;

        return $filasAfectadas;
    }

    function deleteRelacionMatricula($id)
    {
        $sql = "DELETE FROM " . self::$tabla . " WHERE :idmatricula = " . self::$colIdMatricula;
        $filasAfectadas = 0;
        try {
            $this->myPDO->beginTransaction();
            $stmt = $this->myPDO->prepare($sql);
            $stmt->execute([
                ':idmatricula' => $id
            ]);
            $filasAfectadas = $stmt->rowCount();
            //echo "TABLA Asignatura_Matricula: Filas afectadas: $filasAfectadas </br>";
            // echo $filasAfectadas;
            // die();

            if ($filasAfectadas > 0) {
                $this->myPDO->commit();
            }
        } catch (Exception $ex) {
            echo "ha habido una excepción se lanza rollback automático: $ex";
            $this->myPDO->rollback();
        }
        $stmt = null;
        return $filasAfectadas;
    }

    function deleteRelacionAsignatura($id)
    {
        $sql = "DELETE FROM " . self::$tabla . " WHERE :idasignatura = " . self::$colIdAsignatura;
        $filasAfectadas = 0;
        try {
            $this->myPDO->beginTransaction();
            $stmt = $this->myPDO->prepare($sql);
            $stmt->execute([
                ':idasignatura' => $id
            ]);
            $filasAfectadas = $stmt->rowCount();
            //echo "TABLA Asignatura_Matricula: Filas afectadas: $filasAfectadas </br>";
            if ($filasAfectadas > 0) {
                $this->myPDO->commit();
            }
        } catch (Exception $ex) {
            echo "ha habido una excepción se lanza rollback automático: $ex";
            $this->myPDO->rollback();
        }
        $stmt = null;
        return $filasAfectadas;
    }

    function findMatriculasByAsignaturaId($id)
    {
        //SELECT m.id, m.dni, m.year FROM matriculas m INNER JOIN asignatura_matricula am INNER JOIN asignaturas a ON m.id = am.idmatricula WHERE am.idasignatura = 3 AND a.id = 3;
        $stmt = $this->myPDO->prepare("SELECT m." . self::$idMatricula . ", m." . self::$dniMatricula . ", m." . self::$yearMatricula . " FROM " . self::$tablaMatricula . " AS m INNER JOIN " . self::$tabla . " AS am INNER JOIN " . self::$tablaAsignatura . " AS a ON m." . self::$idMatricula . " = am." . self::$colIdMatricula . " WHERE am." . self::$colIdAsignatura . " = $id AND a." . self::$idAsignatura . " = $id");
        $stmt->setFetchMode(PDO::FETCH_ASSOC); //devuelve array asociativo
        $stmt->execute(); // Ejecutamos la sentencia
        $matriculas = [];
        while ($row = $stmt->fetch()) {
            $id = $row["id"];
            $dni = $row["dni"];
            $year = $row["year"];
            $matricula = new Matricula($id, $dni, $year);
            $matriculas[] = $matricula;
        }
        return $matriculas;
    }

    function findAsignaturasByMatriculaId($id)
    {
        //Por visibilidad dejo lo de arriba
        //SELECT a.id, a.nombre, a.curso FROM matriculas m INNER JOIN asignatura_matricula am INNER JOIN asignaturas a ON a.id = am.idasignatura WHERE am.idmatricula = 1 AND m.id = 1;
        $stmt = $this->myPDO->prepare("SELECT a." . self::$idAsignatura . ", a." . self::$nombreAsignatura . ", a." . self::$cursoAsignatura . " FROM " . self::$tablaMatricula . " AS m INNER JOIN " . self::$tabla . " AS am INNER JOIN " . self::$tablaAsignatura . " AS a ON a." . self::$idAsignatura . " = am." . self::$colIdAsignatura . " WHERE am." . self::$colIdMatricula . " = $id AND m." . self::$idMatricula . " = $id");
        $stmt->setFetchMode(PDO::FETCH_ASSOC); //devuelve array asociativo
        $stmt->execute(); // Ejecutamos la sentencia
        $asignaturas = [];
        while ($row = $stmt->fetch()) {
            $id = $row["id"];
            $nombre = $row["nombre"];
            $curso = $row["curso"];
            $asignatura = new Asignatura($id, $nombre, $curso);
            $asignaturas[] = $asignatura;
        }
        return $asignaturas;
    }

    function existsIdMatricula($id){
        $existe = false;
        $sql = "SELECT * FROM " . self::$tabla . " WHERE :idmatricula = " . self::$colIdMatricula;
        $stmt = $this->myPDO->prepare($sql);
        $stmt->execute(
            [
                ':idmatricula' => $id
            ]
        );

        if ($row = $stmt->fetch()) {
            $existe = true;
        }

        return $existe;
    }
}
