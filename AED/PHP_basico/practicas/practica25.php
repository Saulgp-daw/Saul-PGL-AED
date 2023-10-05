<?php
    $array = [];

    for($i = 0; $i < 10; $i++){
        $num_aleatorio = random_int(20, 25);
        array_push($array, $num_aleatorio);
    }

    print_r($array);
    echo "<br>";
    $num_encontrado = array_search(22, $array);
    echo "Número encontrado:  $array[$num_encontrado] en la posición $num_encontrado ";
