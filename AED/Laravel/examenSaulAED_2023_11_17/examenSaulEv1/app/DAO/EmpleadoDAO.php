<?php

namespace App\DAO;

use App\Contracts\EmpleadoContract;
use App\DAO\Crud;
use App\Models\Empleado;
use Exception;
use PDO;

/***
 * @Author saúl
 */

class EmpleadoDAO implements Crud
{

    private static $tabla = EmpleadoContract::TABLE_NAME;
    

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

            $id = $row[EmpleadoContract::COL_ID];
            $nombre = $row[EmpleadoContract::COL_NOMBRE];
            $apellidos = $row[EmpleadoContract::COL_APELLIDOS];
            $fecha_contrato = $row[EmpleadoContract::COL_FECHACONTRATO];
            $jefe = $row[EmpleadoContract::COL_JEFE];
            $numero = $row[EmpleadoContract::COL_NUMERO];
            $calle = $row[EmpleadoContract::COL_CALLE];
            $municipio = $row[EmpleadoContract::COL_MUNICIPIO];

            $empleado = new Empleado($id, $nombre, $apellidos, $fecha_contrato, $jefe, $numero, $calle, $municipio);
            $empleados[] = $empleado;
        }
        return $empleados;
    }

    function save($empleado)
    {
        
        /*$sql = "INSERT INTO ".self::$tabla. " (".EmpleadoContract::COL_ID.", ".EmpleadoContract::COL_NOMBRE.", ".EmpleadoContract::COL_APELLIDOS.", ".EmpleadoContract::COL_FECHACONTRATO.", ".EmpleadoContract::COL_JEFE.", ".EmpleadoContract::COL_NUMERO.", ".EmpleadoContract::COL_CALLE.", ".EmpleadoContract::COL_MUNICIPIO.") VALUES ( :id, :nombre, :apellidos, :fecha_contrato, :jefe, :numero, :calle, :municipio);";*/

        
        
        $sql = "INSERT INTO `empleados`(`id`, `nombre`, `apellidos`, `fecha_contrato`, `jefe`, `numero`, `calle`, `municipio`) 
         VALUES (30,'Pepe','Velázquez',1541876400000,25,69,'Dos Patos','Adeje')";
         
        try {
            $this->myPDO->beginTransaction();
            $stmt = $this->myPDO->prepare($sql);
            /*$stmt->execute(
                [
                    ':id' => $empleado->getId(),
                    ':nombre' => $empleado->getNombre(),
                    ":apellidos" => $empleado->getApellidos(),
                    ":fecha_contrato" => $empleado->getFecha_contrato(),
                    ":jefe" => $empleado->getJefe(),
                    ":numero" => $empleado->getNumero(),
                    ":calle" => $empleado->getCalle(),
                    ":municipio" => $empleado->getMunicipio()
                ]
            );*/
            //si filasAfectadas > 0 => hubo éxito consulta
            $filasAfectadas = $stmt->rowCount();
            echo "Filas afectadas: $filasAfectadas";

            echo "Sentencia: ".$sql;

            if ($filasAfectadas > 0) {
                $this->myPDO->commit();
                $creado = new Empleado($empleado->getId(), $empleado->getNombre(), $empleado->getApellidos(), $empleado->getFecha_contrato(), $empleado->getJefe(), $empleado->getNumero(), $empleado->getCalle(), $empleado->getMunicipio());
            }
        } catch (Exception $ex) {
            echo "ha habido una excepción se lanza rollback automático: $ex";
            $this->myPDO->rollback();
        }
        $stmt = null;

        return $creado ?? null;
    }

    function findById($id)
    {
        $encontrado = null;
        $sql = "SELECT * FROM " . self::$tabla . " WHERE :id = " . EmpleadoContract::COL_ID;
        $stmt = $this->myPDO->prepare($sql);
        $stmt->execute(
            [
                ':id' => $id
            ]
        );

        if ($row = $stmt->fetch()) {
            $empleado = new Empleado(
                $row[EmpleadoContract::COL_ID],
                $row[EmpleadoContract::COL_NOMBRE],
                $row[EmpleadoContract::COL_APELLIDOS],
                $row[EmpleadoContract::COL_FECHACONTRATO],
                $row[EmpleadoContract::COL_JEFE],
                $row[EmpleadoContract::COL_NUMERO],
                $row[EmpleadoContract::COL_CALLE],
                $row[EmpleadoContract::COL_MUNICIPIO]
            );
            $encontrado = $empleado;
        }

        if($encontrado && $encontrado->getJefe() != null){
            $sqlJefe = "SELECT * FROM ".self::$tabla." WHERE :idJefe = ".EmpleadoContract::COL_ID;
            $stmt = $this->myPDO->prepare($sqlJefe);
            $stmt->execute(
                [
                    ':idJefe' => $empleado->getJefe()
                ]
            );
            if ($row = $stmt->fetch()) {
                $jefe = new Empleado(
                    $row[EmpleadoContract::COL_ID],
                    $row[EmpleadoContract::COL_NOMBRE],
                    $row[EmpleadoContract::COL_APELLIDOS],
                    $row[EmpleadoContract::COL_FECHACONTRATO],
                    $row[EmpleadoContract::COL_JEFE],
                    $row[EmpleadoContract::COL_NUMERO],
                    $row[EmpleadoContract::COL_CALLE],
                    $row[EmpleadoContract::COL_MUNICIPIO]
                );
            }
            $encontrado->setJefe($jefe);

        }
        return $encontrado;
    }

    
    function update($alumno)
    {

        /**
         * UPDATE `empleados` SET `id`='[value-1]',`nombre`='[value-2]',`apellidos`='[value-3]',`fecha_contrato`='[value-4]',`jefe`='[value-5]',`numero`='[value-6]',`calle`='[value-7]',`municipio`='[value-8]' WHERE 1
         */

         
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

    function delete($id)
    {
        $sql = "DELETE FROM ".self::$tabla. " WHERE :id = ".EmpleadoContract::COL_ID;
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
