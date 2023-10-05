<?php
    $array = ["a","a","a","a","a"];

    $j=count($array);
    foreach( $array as $key => $val){
        $j--;
        $array[$j] .= $j;
        echo "<br>";
        var_dump($array);
        echo "<br>No llamamos al array: $key => $val"; //esta línea no tiene el efecto deseado
        echo "<br> Llamamos al array: $key => $array[$key]"; // aquí sí
        echo "<br>";
    }
 ?>
