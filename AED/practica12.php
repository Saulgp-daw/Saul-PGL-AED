<?php
    $array = array('uno' => 1, 'dos' => 2, 'tres' => 40, 'cuatro' => 55);
    $cadena = "La posición 'tres' contiene el dato $array['tres']";
    //El error que ocurre es debido a las comillas simples que entran en conflicto con las dobles que las rodean
    echo $cadena;
