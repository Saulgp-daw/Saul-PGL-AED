<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona
{
   // use HasFactory;
    public $id;
    public $nombre;
    public $edad;

    public function __construct($id=null, $nombre=null, $edad=null){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->edad = $edad;
    }
}
