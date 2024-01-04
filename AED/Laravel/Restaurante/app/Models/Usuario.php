<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    //use HasFactory;
    private int $telefono;
    private string $nombre;
    private string $contrasenha;
    private string $rol;

    public function __construct(int $telefono=000, string $nombre="null", string $contrasenha="null", string $rol = "CLIENTE"){
        $this->telefono = $telefono;
        $this->nombre = $nombre;
        $this->contrasenha = $contrasenha;
        $this->rol = $rol;
    }

    /**
     * Get the value of telefono
     */ 
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set the value of telefono
     *
     * @return  self
     */ 
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

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
     * Get the value of contrasenha
     */ 
    public function getContrasenha()
    {
        return $this->contrasenha;
    }

    /**
     * Set the value of contrasenha
     *
     * @return  self
     */ 
    public function setContrasenha($contrasenha)
    {
        $this->contrasenha = $contrasenha;

        return $this;
    }

    /**
     * Get the value of rol
     */ 
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * Set the value of rol
     *
     * @return  self
     */ 
    public function setRol($rol)
    {
        $this->rol = $rol;

        return $this;
    }
}
