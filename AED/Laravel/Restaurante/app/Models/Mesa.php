<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
    //use HasFactory;
    private int $num_mesa;
    private int $sillas;
    private bool $disponible;

    public function __construct($num_mesa = 0, $sillas = 0, $disponible = false ){
        $this->num_mesa = $num_mesa;
        $this->sillas = $sillas;
        $this->disponible = $disponible;
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
     * Get the value of sillas
     */ 
    public function getSillas()
    {
        return $this->sillas;
    }

    /**
     * Set the value of sillas
     *
     * @return  self
     */ 
    public function setSillas($sillas)
    {
        $this->sillas = $sillas;

        return $this;
    }

    /**
     * Get the value of disponible
     */ 
    public function getDisponible()
    {
        return $this->disponible;
    }

    /**
     * Set the value of disponible
     *
     * @return  self
     */ 
    public function setDisponible($disponible)
    {
        $this->disponible = $disponible;

        return $this;
    }
}
