<?php
/**
*Generar un array de tamaño aleatorio entre 10 y 20 inclusives
*los números generados serán del 1 al 20
*Se debe mostrar el array generado y luego la siguiente salida
*Aparece por repeticiones de más a menos 20 => 3 repeticiones etc
*/

$arrayAleatorio = [];

for($i = 0; $i < 20; $i++){
    $num_aleatorio = random_int(10, 20);
    array_push($arrayAleatorio, $num_aleatorio);
}
rsort($arrayAleatorio);

$arrayTexto = "";
$arrayTexto = "Array [";
foreach ($arrayAleatorio as $key => $value) {
   $arrayTexto .= $value . ", ";
}
$arrayTexto = rtrim($arrayTexto, ", ");
$arrayTexto .= "]";
echo $arrayTexto;

$otroArray = [];

foreach ($arrayAleatorio as $key => $value) {
    $repeticiones = 0;
    for($i = 0; $i < count($arrayAleatorio); $i++){
        if($value == $arrayAleatorio[$i]){
            $repeticiones++;
            $otroArray[$value] = $repeticiones;
        }
    }
}

//EN MENOS CÓDIGO
/**
 * $otroArray[$value] = $otroArray[$value]??0;
 * $otroArray[$value]++;
 */

arsort($otroArray);
echo "<br>";
print_r($otroArray);













