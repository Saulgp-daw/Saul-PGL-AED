<?php
namespace App\DAO;

    interface Crud{
        function findAll();

        function save($dao);

        function findById($id);

        function update($dao);

        function delete($id);
    }
