<?php
    $array = array('azul', 'rojo', 'verde', 'amarillo', "blanco");
    $array = array_values($array);
    print_r($array);
    $encontrado = in_array("azul", $array);
    if($encontrado){
        echo "<br>Se ha encontrado el valor";
    }else{
        echo "<br>No se ha encontrado el valor";
    }

    $usandoArraySearch = array_search("rojo", $array);
    
    if($usandoArraySearch){
        echo "<br>Se ha encontrado $array[$usandoArraySearch] el valor, en la posición: $usandoArraySearch ";
    }else{
        echo "<br>No se ha encontrado el valor";
    }

    //La diferencia entre ambos es que uno devuelve true o false si lo encuentra y el otro su posición en el array o false

?>