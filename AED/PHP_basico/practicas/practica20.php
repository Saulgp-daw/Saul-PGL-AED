<?php
$arr = ["1", "2", "3", "4"];
$va = array_pop($arr);
echo "el array ahora queda: <br>";
print_r($arr);
echo "<br>el valor extraido es: " . $va;
//devuelve el valor en la última posición del array, puesto que pop trata un array como una pila (LIFO)
?>