<?php

namespace App\Contracts;

class ReservaMesaContract {
    public const TABLE_NAME="reservas_mesas";
    public const COL_ID="id_reserva_mesa";
    public const COL_ID_BOOK="id_reserva";
    public const COL_SEAT_NUM="num_mesa";
}