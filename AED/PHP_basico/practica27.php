<?php
    $array = [7,2,8,1,9,4];
    print_r($array);

    echo "<br> Array search devuelve la posición: " . array_search(4, $array) . "<br>";
    usort($array, "cmp");
    print_r($array);

    echo "<br> Array search devuelve la posición: " . array_search(4, $array);

    function cmp($a, $b){
        return $a <=> $b;
    }