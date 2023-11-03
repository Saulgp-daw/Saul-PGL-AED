<?php

namespace App\DAO;

use App\Contracts\AlumnoContract;
use App\DAO\Crud;
use App\Models\Alumno;
use Exception;
use PDO;

class AlumnoDAO implements Crud
{

    private static $tabla = AlumnoContract::TABLE_NAME;
    private static $colDni = AlumnoContract::COL_DNI;
    private static $colNombre = AlumnoContract::COL_NOMBRE;
    private static $colApellidos = AlumnoContract::COL_APELLIDOS;
    private static $colFechaNacimiento = AlumnoContract::COL_FECHANACIMIENTO;

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
        $alumnos = [];
        while ($row = $stmt->fetch()) {

            $dni = $row[self::$colDni];
            $nombre = $row[self::$colNombre];
            $apellidos = $row[self::$colApellidos];
            $fechaNacimiento = $row[self::$colFechaNacimiento];
            $alumno = new Alumno($dni, $nombre, $apellidos, $fechaNacimiento);
            $alumnos[] = $alumno;
        }
        return $alumnos;
    }

    function save($alumno)
    {
        $sql = "INSERT INTO " . self::$tabla . " (" . self::$colDni . ", " . self::$colNombre . ", " . self::$colApellidos . ", " . self::$colFechaNacimiento . ")
        VALUES (:dni, :nombre, :apellidos, :fechanacimiento)";

        try {
            $this->myPDO->beginTransaction();
            $stmt = $this->myPDO->prepare($sql);
            $stmt->execute(
                [
                    ':dni' => $alumno->dni,
                    ':nombre' => $alumno->nombre,
                    ":apellidos" => $alumno->apellidos,
                    ":fechanacimiento" => $alumno->fechaNacimiento
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
        $alumnoCreado = new Alumno($alumno->dni, $alumno->nombre, $alumno->apellidos, $alumno->fechaNacimiento);
        return $alumnoCreado;
    }

    function findById($dni)
    {
        $alumnoEncontrado = null;
        $sql = "SELECT * FROM " . self::$tabla . " WHERE :dni = " . self::$colDni;
        $stmt = $this->myPDO->prepare($sql);
        $stmt->execute(
            [
                ':dni' => $dni
            ]
        );

        if ($row = $stmt->fetch()) {
            $alumno = new Alumno();
            $alumno->dni = $row[self::$colDni];
            $alumno->nombre = $row[self::$colNombre];
            $alumno->apellidos = $row[self::$colApellidos];
            $alumno->fechaNacimiento = $row[self::$colFechaNacimiento];
            $alumnoEncontrado = $alumno;
        }

        return $alumnoEncontrado;
    }

    function findByName($nombre)
    {
        $alumnoEncontrado = null;
        $sql = "SELECT * FROM " . self::$tabla . " WHERE UPPER(:nombre) = UPPER(" . self::$colNombre.")";
        $stmt = $this->myPDO->prepare($sql);
        $stmt->execute(
            [
                ':nombre' => $nombre
            ]
        );

        if ($row = $stmt->fetch()) {
            $alumno = new Alumno();
            $alumno->dni = $row[self::$colDni];
            $alumno->nombre = $row[self::$colNombre];
            $alumno->apellidos = $row[self::$colApellidos];
            $alumno->fechaNacimiento = $row[self::$colFechaNacimiento];
            $alumnoEncontrado = $alumno;
        }

        return $alumnoEncontrado;
    }

    function update($alumno)
    {
        $sql = "UPDATE ". self::$tabla. " SET ".self::$colNombre. " = :nombre, ".
        self::$colApellidos. " = :apellidos, ".self::$colFechaNacimiento. " = :fechanacimiento WHERE ".self::$colDni . " = :dni";

        try{
            $this->myPDO->beginTransaction();
            $stmt = $this->myPDO->prepare($sql);
            $stmt->execute(
                [
                    ':dni' => $alumno->dni,
                    ':nombre' => $alumno->nombre,
                    ":apellidos" => $alumno->apellidos,
                    ":fechanacimiento" => $alumno->fechaNacimiento
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

    function delete($dni)
    {
        $sql = "DELETE FROM ".self::$tabla. " WHERE :dni = ".self::$colDni;
        try{
            $this->myPDO->beginTransaction();
            $stmt = $this->myPDO->prepare($sql);
            $stmt->execute(
                [
                    ':dni' => $dni
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
}
