<?php
    function modify(array &$arr): void {
        $arr[] = 4;
    }
    $a = [1];
    modify($a);
    print_r($a);
 ?>
