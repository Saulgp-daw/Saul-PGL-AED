<?php


$mivar  = [];
array_push($mivar, "uno");

$arr1 = $mivar;
$arr2 = &$mivar;

print_r($mivar);
echo "<br>";
$arr1[0] = "una variación";
$arr2[0] = "segunda variación";


echo "\$mivar: $mivar[0] \$arr1: $arr1[0]";

//El paso por referencia ($arr2) ha modificado el valor del array original.