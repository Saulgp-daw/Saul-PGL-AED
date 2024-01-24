<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
    //use HasFactory;
    private int $num_mesa;
    private int $sillas;

    public function __construct($num_mesa = 0, $sillas = 0 ){
        $this->num_mesa = $num_mesa;
        $this->sillas = $sillas;
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

   
}
