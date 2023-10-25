<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\DAO\PersonaDAO;

class PersonaController extends Controller
{
    public function obtenerPersonas(){
        $pdo = DB::getPdo();
        $personaDAO = new PersonaDAO($pdo);
        $personas = $personaDAO->findAll();
        var_dump($personas);
        die();
    }

    public function guardarPersona(){
        $pdo = DB::getPdo();
        $personaDAO = new PersonaDAO($pdo);
        $persona = new Persona(null, "Pepe", 24);
        $personaDAO->save($persona);
    }

    public function devolverPersona($id){
        $pdo = DB::getPdo();
        $personaDAO = new PersonaDAO($pdo);
        $persona = $personaDAO->findById($id);
        var_dump($persona);
    }
}
