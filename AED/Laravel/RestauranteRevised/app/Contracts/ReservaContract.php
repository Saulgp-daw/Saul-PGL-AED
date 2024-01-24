<?php

namespace App\Contracts;

class ReservaContract {
    public const TABLE_NAME="reservas";
    public const COL_ID="id_reserva";
    public const COL_TEL="telefono";
    public const COL_DATE="fecha_hora";
    public const COL_DURATION="duracion";
    public const COL_NUM_TABLE = "num_mesa";
    public const COL_STATE = "estado";
}