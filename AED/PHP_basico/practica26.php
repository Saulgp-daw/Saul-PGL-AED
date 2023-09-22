<?php
/*function cmp($a, $b)
{
    if ($a == $b) {
        return 0;
    }
    return ($a < $b) ? -1 : 1;
}

usort($a, "cmp");*/


function compare($a, $b){
    return $a <=> $b;
}
$a = array(3, 2, 5, 6, 1);
usort($a, "compare");

foreach ($a as $valor) {
    echo " $valor, ";
}