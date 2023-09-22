<?php
    $array = [];
    for($i = 1; $i < 11; $i++){
        array_unshift($array, $i);
    }

    print_r($array);