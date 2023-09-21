<?php
   $array = array(
    "a",
    "b",
6 => "c",
    "d",
);
//El error sale al encontrar posiciones donde no se encuentra nada en ella
    for($i = 0; $i < count($array); $i++){
        var_dump($array[$i]);
    }
?>