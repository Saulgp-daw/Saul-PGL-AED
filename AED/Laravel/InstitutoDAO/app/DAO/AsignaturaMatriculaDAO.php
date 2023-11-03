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

    private $myPDO;
    public function __construct($pdo)
    {
        $this->myPDO = $pdo;
    }

    function deleteRelacionMatricula($id)
    {
        $sql = "DELETE FROM " . self::$tabla . " WHERE :id = " . self::$colIdMatricula;
        try {
            $this->myPDO->beginTransaction();
            $stmt = $this->myPDO->prepare($sql);
            $stmt->execute([
                ':id' => $id
            ]);
            $filasAfectadas = $stmt->rowCount();
            echo "TABLA Asignatura_Matricula: Filas afectadas: $filasAfectadas </br>";
            if ($filasAfectadas > 0) {
                $this->myPDO->commit();
            }
        } catch (Exception $ex) {
            echo "ha habido una excepción se lanza rollback automático: $ex";
            $this->myPDO->rollback();
        }
        $stmt = null;
    }
}
