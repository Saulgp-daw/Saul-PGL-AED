<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Alumno extends Model
{
    //use HasFactory;
    public $dni;
    public $nombre;
    public $apellidos;
    public $fechaNacimiento;

    public function __construct($dni=null, $nombre=null, $apellidos=null, $fechaNacimiento=null){
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->fechaNacimiento = $fechaNacimiento;
    }
}
