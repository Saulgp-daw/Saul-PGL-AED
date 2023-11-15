<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    //use HasFactory;
    /**
     * @var string $nombre
     */
    protected $nombre;
     /**
     * @var string $apellidos
     */
    protected $apellidos;
    /**
     * @var int $edad
     */
    protected $edad;

    public function __construct($nombre, $apellidos, $edad){
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->edad = $edad;
    }




    /**
     * Get $apellidos
     *
     * @return  string
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set $apellidos
     *
     * @param  string  $apellidos  $apellidos
     *
     * @return  self
     */
    public function setApellidos(string $apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

     /**
      * Get the value of nombre
      */
     public function getNombre()
     {
          return $this->nombre;
     }

     /**
      * Set the value of nombre
      *
      * @return  self
      */
     public function setNombre($nombre)
     {
          $this->nombre = $nombre;

          return $this;
     }

     /**
      * Get the value of edad
      */
     public function getEdad()
     {
          return $this->edad;
     }

     /**
      * Set the value of edad
      *
      * @return  self
      */
     public function setEdad($edad)
     {
          $this->edad = $edad;

          return $this;
     }
}
