<?php
    $num = 2;
    $concatenacion = "";
    for($i = 1; $i < 10; $i++){
        echo $num**$i . "<br>";
        $concatenacion .= $num**$i;
    }
    echo "Concatenacion: " . $concatenacion;

