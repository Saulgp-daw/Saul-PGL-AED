<?php
    function sumar($a, $b): float
    {
        $suma = $a + $b;
        if ($print) {
            echo "resultado suma: $suma <br>";
        }
        return $suma;

    }
    $sum1=sumar(1,2);
    $sum2=sumar(4,5,true);

    echo "las operaciones para sum1 y sum2 dan: $sum1 , $sum2";
    //el programa sigue ejecutándose pero cuenta como indefinida el parámetro print del if
 ?>