<?php
    $foo = 2; // Asigna el valor 'Bob' a $foo
    $bar = &$foo; // Referencia $foo vía $bar.
    $bar = "Mi nombre es $bar"; // Modifica $bar...
    echo $foo; // $foo también se modifica.
    echo $bar;

    //Las referencias funcionan con números también
?>