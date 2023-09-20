<?php
    echo "--------------array push--------------------------------<br>";
    $array = [];
    for($i = 1; $i <= 10; $i++){
        array_push($array, $i);
        print_r($array);
        echo "<br>";
    }
    echo "------------------------Array pop------------------------<br>";
    for($i = 1; $i < 6; $i++){
        array_pop($array);
        print_r($array);
        echo "<br>";
    }