<?php
    $variable = '$dato';
    for ($i = 0; $i < 10; $i++) {
        ${'dato' .$i}  = $i;
    }
    echo "<br> $dato3 ";
    echo "<br> $dato8 ";
?>