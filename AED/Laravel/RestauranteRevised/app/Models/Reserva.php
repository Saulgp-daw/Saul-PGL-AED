<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Datetime;

class Reserva extends Model
{
    //use HasFactory;
    private int $id_reserva;
    private int $telefono;
    private Datetime $fecha_hora;
    private int $duracion;
    private int $num_mesa;
    private string $estado;

    public function __construct(int $id_reserva = 0, int $telefono=0, Datetime $fecha_hora = new Datetime(), int $duracion=0, int $num_mesa=0, string $estado="Sin confirmar")
    {
        $this->id_reserva = $id_reserva;
        $this->telefono = $telefono;
        $this->fecha_hora = $fecha_hora;
        $this->duracion = $duracion;
        $this->num_mesa = $num_mesa;
        $this->estado = $estado;
    }




    /**
     * Get the value of id_reserva
     */ 
    public function getId_reserva()
    {
        return $this->id_reserva;
    }

    /**
     * Set the value of id_reserva
     *
     * @return  self
     */ 
    public function setId_reserva($id_reserva)
    {
        $this->id_reserva = $id_reserva;

        return $this;
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
     * Get the value of fecha_hora
     */ 
    public function getFecha_hora()
    {
        return $this->fecha_hora;
    }

    /**
     * Set the value of fecha_hora
     *
     * @return  self
     */ 
    public function setFecha_hora($fecha_hora)
    {
        $this->fecha_hora = $fecha_hora;

        return $this;
    }

        /**
         * Get the value of duracion
         */ 
        public function getDuracion()
        {
                return $this->duracion;
        }

        /**
         * Set the value of duracion
         *
         * @return  self
         */ 
        public function setDuracion($duracion)
        {
                $this->duracion = $duracion;

                return $this;
        }

    /**
     * Get the value of num_mesa
     */ 
    public function getNum_mesa()
    {
        return $this->num_mesa;
    }

    /**
     * Set the value of num_mesa
     *
     * @return  self
     */ 
    public function setNum_mesa($num_mesa)
    {
        $this->num_mesa = $num_mesa;

        return $this;
    }

    /**
     * Get the value of estado
     */ 
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set the value of estado
     *
     * @return  self
     */ 
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }
}
