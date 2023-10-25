<?php
namespace App\DAO;

    interface Crud{
        function findAll();

        function save($persona);

        function findById($id);

        function update($dao);

        function delete($id);
    }
