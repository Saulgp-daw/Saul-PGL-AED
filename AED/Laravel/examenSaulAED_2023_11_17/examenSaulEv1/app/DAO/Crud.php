<?php
namespace App\DAO;
/***
 * @Author saúl
 */


    interface Crud{
        function findAll();

        function save($dao);

        function findById($id);

        function update($dao);

        function delete($id);
    }
