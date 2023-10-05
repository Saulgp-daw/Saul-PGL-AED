<?php
    function modify(int &$a): void {
        $a = 3;
    }
    $a = 2;
    modify($a);
    print_r($a);
    //Esta vez sí que se modifica el valor original
 ?>
