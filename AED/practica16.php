<?php
    $array = array('perro', 'gato', 'avestruz');
    foreach ($array as $clave => $valor) {
        print "<br>array[ $clave ] = $valor";
    }
    //No hace falta que se llamen $key y $val, mientras estén en el orden correcto 
    //sabrá cuál es la clave y cual el valor
?>