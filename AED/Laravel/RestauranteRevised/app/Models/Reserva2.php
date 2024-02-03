<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva2 extends Model
{

    //use HasFactory;
    private int $id_reserva;
    private $usuario;
    private int $fecha_hora;
    private int $duracion;
    private int $num_mesa;
    private string $estado;

    public function __construct(int $id_reserva = 0, $usuario = null, int $fecha_hora = 0, int $duracion = 0, int $num_mesa = 0, string $estado = "Sin confirmar")
    {
        $this->id_reserva = $id_reserva;
        $this->usuario = $usuario;
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

    public function getUsuario(){
        return $this->usuario;
    }

    public function setUsuario($usuario){
        $this->usuario = $usuario;
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
