<?php
    function modify(int $a): void {
        $a = 3;
    }
    $a = 2;
    modify($a);
    print_r($a);
    //estamos pasando por valor, por eso no se modifica la variable
 ?>