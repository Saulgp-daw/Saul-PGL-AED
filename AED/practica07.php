<?php
    //El var_dump mostrará la variable destruida con unset y la tratará como nula, pero saldrá un error de que no está definida

    $variable = null;
    var_dump($variable);
    unset($variable);
    var_dump($variable);