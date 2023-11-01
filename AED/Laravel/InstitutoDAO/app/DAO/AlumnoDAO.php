<?php

namespace App\DAO;

use App\Contracts\AlumnoContract;
use App\DAO\Crud;
use App\Models\Alumno;
use Exception;
use PDO;

class AlumnoDAO implements Crud {

    private $myPDO;
    public function __construct($pdo)
    {
        $this->myPDO = $pdo;
    }

    function findAll(){

    }

    function save($dao){

    }

    function findById($id){

    }

    function update($dao){

    }

    function delete($id){

    }
}
