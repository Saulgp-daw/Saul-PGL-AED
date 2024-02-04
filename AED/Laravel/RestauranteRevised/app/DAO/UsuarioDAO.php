<?php

namespace App\DAO;

use App\Contracts\UsuarioContract;
use App\DAO\Crud;
use App\Models\Usuario;
use Exception;
use PDO;


class UsuarioDAO implements Crud
{
    private $myPDO;

    public function __construct($pdo)
    {
        $this->myPDO = $pdo;
    }

    public function findAll(){
        $stmt = $this->myPDO->prepare("SELECT * FROM " . UsuarioContract::TABLE_NAME);
        $stmt->setFetchMode(PDO::FETCH_ASSOC); //devuelve array asociativo
        $stmt->execute(); // Ejecutamos la sentencia
        $usuarios = [];
        while ($row = $stmt->fetch()) {

            $telefono = $row[UsuarioContract::COL_TEL];
            $nombre = $row[UsuarioContract::COL_NAME];
            $contrasenha = $row[UsuarioContract::COL_PASSWORD];
            $rol = $row[UsuarioContract::COL_ROLE];
            $usuario = new Usuario($telefono, $nombre, $contrasenha, $rol);
            $usuarios[] = $usuario;
        }
        return $usuarios;
    }

    public function save($usuario)
    {
        //INSERT INTO `usuarios`(`telefono`, `nombre`, `contrasenha`, `rol`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]')
        $sql = "INSERT INTO " . UsuarioContract::TABLE_NAME . " (" .
            UsuarioContract::COL_TEL . ", " .
            UsuarioContract::COL_NAME . " , " .
            UsuarioContract::COL_PASSWORD . ", " .
            UsuarioContract::COL_ROLE .
            ") VALUES(:telefono, :nombre, :contrasenha, :rol)";

        try {
            $this->myPDO->beginTransaction();
            $stmt = $this->myPDO->prepare($sql);
            $stmt->execute(
                [
                    ":telefono" => $usuario->getTelefono(),
                    ":nombre" => $usuario->getNombre(),
                    ":contrasenha" => $usuario->getContrasenha(),
                    ":rol" => $usuario->getRol()
                ]
            );

            $filasAfectadas = $stmt->rowCount();

            if ($filasAfectadas > 0) {
                $this->myPDO->commit();
                $usuarioCreado = new Usuario($usuario->getTelefono(), $usuario->getNombre(), $usuario->getContrasenha(), $usuario->getRol());
            }
        } catch (Exception $ex) {
            echo "ha habido una excepción se lanza rollback automático: $ex";
            $this->myPDO->rollback();
        }
        $stmt = null;
        return $usuarioCreado ?? null;
    }

    public function findById($id)
    {
        $usuarioEncontrado = null;
        //SELECT * FROM `usuarios` WHERE telefono=123456789
        $sql = "SELECT * FROM " . UsuarioContract::TABLE_NAME . " WHERE " . UsuarioContract::COL_TEL . " = :telefono";

        $stmt = $this->myPDO->prepare($sql);
        $stmt->execute(
            [
                ':telefono' => $id
            ]
        );

        if ($row = $stmt->fetch()) {
            $usuario = new Usuario();
            $usuario->setTelefono($row[UsuarioContract::COL_TEL]);
            $usuario->setNombre($row[UsuarioContract::COL_NAME]);
            $usuario->setContrasenha($row[UsuarioContract::COL_PASSWORD]);
            $usuario->setRol($row[UsuarioContract::COL_ROLE]);
            $usuarioEncontrado = $usuario;
        }

        return $usuarioEncontrado;
    }

    public function delete($id)
    {
        $sql = "DELETE FROM " . UsuarioContract::TABLE_NAME . " WHERE " . UsuarioContract::COL_TEL . " = :telefono";
        $borrado = false;
        try {
            $this->myPDO->beginTransaction();
            $stmt = $this->myPDO->prepare($sql);
            $stmt->execute(
                [
                    ':telefono' => $id
                ]
            );
            $filasAfectadas = $stmt->rowCount();

            if ($filasAfectadas > 0) {
                $this->myPDO->commit();
                $borrado = true;
            }
        } catch (Exception $ex) {
            echo "ha habido una excepción se lanza rollback automático: $ex";
            $this->myPDO->rollback();
        }
        $stmt = null;

        return $borrado;
    }

    public function update($usuario){
        $sql = "UPDATE ". UsuarioContract::TABLE_NAME. " SET ".UsuarioContract::COL_NAME ." = :nombre, " . UsuarioContract::COL_PASSWORD . " = :password, ". UsuarioContract::COL_ROLE . " = :rol WHERE " . UsuarioContract::COL_TEL . " = :telefono";
        $actualizado = false;

        try{
            $this->myPDO->beginTransaction();
            $stmt = $this->myPDO->prepare($sql);
            $stmt->execute([
                ':nombre' => $usuario->getNombre(),
                ':password' => $usuario->getContrasenha(),
                ':rol' => $usuario->getRol(),
                ':telefono' => $usuario->getTelefono()
            ]);




            $filasAfectadas = $stmt->rowCount();

            if ($filasAfectadas > 0) {
                $actualizado = true;
                $this->myPDO->commit();
            }

        }catch(Exception $ex){
            echo "ha habido una excepción se lanza rollback automático: $ex";
            $this->myPDO->rollback();
        }

        $stmt = null;
        return $actualizado;
    }


}
