<?php

namespace App\DAO;

use App\Contracts\UsuarioContract;
use App\DAO\Crud;
use App\Models\Alumno;
use Exception;
use PDO;

class UsuarioDAO
{

    private static $tabla = UsuarioContract::TABLE_NAME;
    private static $colNickname = UsuarioContract::COL_NICKNAME;
    private static $colPassword = UsuarioContract::COL_PASSWORD;

    private $myPDO;
    public function __construct($pdo)
    {
        $this->myPDO = $pdo;
    }

    function register($nickname, $password_hash)
    {

        $sql = "INSERT INTO " . self::$tabla . " (" . self::$colNickname . ", " . self::$colPassword . ") VALUES (:nickname, :password_hash)";
        $filasAfectadas = 0;
        try {
            $this->myPDO->beginTransaction();
            $stmt = $this->myPDO->prepare($sql);
            $stmt->execute(
                [
                    ':nickname' => $nickname,
                    ':password_hash' => $password_hash
                ]
            );
            //si filasAfectadas > 0 => hubo éxito consulta
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

    function login($nickname, $password_hash){
        //SELECT * FROM `usuarios` WHERE nickname = "saul" AND password_hash = "1234";
        $stmt = $this->myPDO->prepare("select * from ".self::$tabla);
        $stmt->execute();

        $claveCorrecta = false;
        foreach( $stmt->fetchAll() as $fila){
            if( $fila["nickname"] == $nickname){
                //print_r($fila);
                $clave = $fila["password_hash"];
                //echo " $clave <br>";

                if( password_verify($password_hash, $clave)){
                    $claveCorrecta = true;
                }
            }
        }
        return $claveCorrecta;
    }

    function checkIfnicknameExists($nickname){
        $stmt = $this->myPDO->prepare("SELECT * FROM " . self::$tabla. " WHERE :nickname = ".self::$colNickname);
        $stmt->setFetchMode(PDO::FETCH_ASSOC); //devuelve array asociativo
        $stmt->execute(
            [
                ':nickname' => $nickname
            ]
        ); // Ejecutamos la sentencia
        $filasAfectadas = 0;
        while ($row = $stmt->fetch()) {
            $filasAfectadas = 1;
        }
        return $filasAfectadas;
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
            //echo "Filas afectadas: $filasAfectadas";

            if ($filasAfectadas > 0) {
                $this->myPDO->commit();
                $alumnoCreado = new Alumno($alumno->dni, $alumno->nombre, $alumno->apellidos, $alumno->fechaNacimiento);
            }
        } catch (Exception $ex) {
            echo "ha habido una excepción se lanza rollback automático: $ex";
            $this->myPDO->rollback();
        }
        $stmt = null;

        return $alumnoCreado ?? null;
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
        $alumnosEncontrados = [];
        $sql = "SELECT * FROM " . self::$tabla . " WHERE UPPER(:nombre) = UPPER(" . self::$colNombre.")";
        $stmt = $this->myPDO->prepare($sql);
        $stmt->execute(
            [
                ':nombre' => $nombre
            ]
        );

        while ($row = $stmt->fetch()) {
            $alumno = new Alumno();
            $alumno->dni = $row[self::$colDni];
            $alumno->nombre = $row[self::$colNombre];
            $alumno->apellidos = $row[self::$colApellidos];
            $alumno->fechaNacimiento = $row[self::$colFechaNacimiento];
            $alumnosEncontrados[] = $alumno;
        }

        return $alumnosEncontrados;
    }



    function update($alumno)
    {
        $sql = "UPDATE ". self::$tabla. " SET ".self::$colNombre. " = :nombre, ".
        self::$colApellidos. " = :apellidos, ".self::$colFechaNacimiento. " = :fechanacimiento WHERE ".self::$colDni . " = :dni";
        $filasAfectadas = 0;
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
            //echo "Filas afectadas: $filasAfectadas";

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

    function delete($dni)
    {
        $sql = "DELETE FROM ".self::$tabla. " WHERE :dni = ".self::$colDni;
        $filasAfectadas = 0;
        try{
            $this->myPDO->beginTransaction();
            $stmt = $this->myPDO->prepare($sql);
            $stmt->execute(
                [
                    ':dni' => $dni
                ]
            );
            $filasAfectadas = $stmt->rowCount();
            //echo "Filas afectadas: $filasAfectadas";

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
