<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/***
 * @Author saúl
 */

class Empleado extends Model
{
    //use HasFactory;

    public $id;
    public $nombre;
    public $apellidos;
    public $fecha_contrato;
    public $jefe;
    public $numero;
    public $calle;
    public $municipio;

    public function __construct($id=null, $nombre=null,$apellidos=null, $fecha_contrato=null, $jefe=null, $numero=null, $calle=null, $municipio=null){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->fecha_contrato = $fecha_contrato;
        $this->jefe = $jefe;
        $this->numero = $numero;
        $this->calle = $calle;
        $this->$municipio = $municipio;
        
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

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
     * Get the value of apellidos
     */ 
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set the value of apellidos
     *
     * @return  self
     */ 
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get the value of fecha_contrato
     */ 
    public function getFecha_contrato()
    {
        return $this->fecha_contrato;
    }

    /**
     * Set the value of fecha_contrato
     *
     * @return  self
     */ 
    public function setFecha_contrato($fecha_contrato)
    {
        $this->fecha_contrato = $fecha_contrato;

        return $this;
    }

    /**
     * Get the value of jefe
     */ 
    public function getJefe()
    {
        return $this->jefe;
    }

    /**
     * Set the value of jefe
     *
     * @return  self
     */ 
    public function setJefe($jefe)
    {
        $this->jefe = $jefe;

        return $this;
    }

    /**
     * Get the value of numero
     */ 
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set the value of numero
     *
     * @return  self
     */ 
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get the value of calle
     */ 
    public function getCalle()
    {
        return $this->calle;
    }

    /**
     * Set the value of calle
     *
     * @return  self
     */ 
    public function setCalle($calle)
    {
        $this->calle = $calle;

        return $this;
    }

    /**
     * Get the value of municipio
     */ 
    public function getMunicipio()
    {
        return $this->municipio;
    }

    /**
     * Set the value of municipio
     *
     * @return  self
     */ 
    public function setMunicipio($municipio)
    {
        $this->municipio = $municipio;

        return $this;
    }
}
