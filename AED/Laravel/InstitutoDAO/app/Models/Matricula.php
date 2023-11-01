<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    //use HasFactory;
    public $id;
    public $dni;
    public $year;


    public function __construct($id=null, $dni=null, $year=null){
        $this->id = $id;
        $this->dni = $dni;
        $this->year = $year;
    }
}
