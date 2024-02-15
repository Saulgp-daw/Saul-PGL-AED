<?php

namespace App\DAO;

use App\Contracts\AsignaturaContract;
use App\Contracts\MatriculaContract;
use App\Contracts\AlumnoContract;
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
    //ALUMNO
    private static $tablaAlumno = AlumnoContract::TABLE_NAME;
    private static $colDniAlumno = AlumnoContract::COL_DNI;
    private static $colNombrealumno = AlumnoContract::COL_NOMBRE;
    private static $colApellidosalumno = AlumnoContract::COL_APELLIDOS;
    private static $colFechaNacimientoAlumno = AlumnoContract::COL_FECHANACIMIENTO;


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

    function buscarAlumnoConAsignaturaPorYearYNombre($nombre, $year)
    {
        //SELECT al.dni, al.nombre, al.apellidos, al.fechanacimiento, a.id, a.nombre, m.year FROM matriculas m INNER JOIN asignatura_matricula am INNER JOIN asignaturas a INNER JOIN alumnos al ON al.dni = m.dni  AND a.id = am.idasignatura AND m.id = am.idmatricula WHERE m.year = 2006  AND a.nombre = "AED";


        // $sql = "SELECT al.dni, al.nombre AS nombreAlumno, al.apellidos, al.fechanacimiento, a.id, a.nombre as nombreAsignatura, m.year FROM matriculas m INNER JOIN asignatura_matricula am INNER JOIN asignaturas a INNER JOIN alumnos al ON al.dni = m.dni  AND a.id = am.idasignatura AND m.id = am.idmatricula WHERE m.year = 2006  AND a.nombre = 'AED'";

        $sql = "SELECT al.". self::$colDniAlumno .", al.".self::$colNombrealumno ." AS nombreAlumno, al.".self::$colApellidosalumno.", al.".self::$colFechaNacimientoAlumno.", a.".self::$idAsignatura.", a.".self::$nombreAsignatura." AS nombreAsignatura, m.".self::$yearMatricula." FROM " . self::$tablaMatricula . " AS m INNER JOIN ".self::$tabla." AS am INNER JOIN ".self::$tablaAsignatura." AS a INNER JOIN ".self::$tablaAlumno." AS al ON al.".self::$colDniAlumno." = m.".self::$dniMatricula." AND a.".self::$idAsignatura." = am.".self::$colIdAsignatura." AND m.".self::$idMatricula." = am.".self::$colIdMatricula. " WHERE m.".self::$yearMatricula." = :year AND a.".self::$nombreAsignatura." = :nombre";


        $stmt = $this->myPDO->prepare($sql);

        $stmt->setFetchMode(PDO::FETCH_ASSOC); //devuelve array asociativo
        $stmt->execute(
            [
                ":year" => $year,
                ":nombre" => $nombre
            ]
        ); // Ejecutamos la sentencia

        $alumnosYearNombre = [];
        while ($row = $stmt->fetch()) {
            $id = $row["dni"];
            $nombreAlumno = $row["nombreAlumno"];
            $apellidos = $row["apellidos"];
            $fechaNacimiento = $row["fechanacimiento"];
            $nombreAsignatura = $row["nombreAsignatura"];
            $year = $row["year"];
            $datos = $id . " " . $nombreAlumno . " " . $apellidos . " " . $fechaNacimiento . " " . $nombreAsignatura . " " . $year;

            $alumnosYearNombre[] = $datos;
        }


        return $alumnosYearNombre;
    }

    function existsIdMatricula($id)
    {
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

    function existsIdAsignatura($id)
    {
        $existe = false;
        $sql = "SELECT * FROM " . self::$tabla . " WHERE :idasignatura = " . self::$colIdAsignatura;
        $stmt = $this->myPDO->prepare($sql);
        $stmt->execute(
            [
                ':idasignatura' => $id
            ]
        );

        if ($row = $stmt->fetch()) {
            $existe = true;
        }

        return $existe;
    }
}
