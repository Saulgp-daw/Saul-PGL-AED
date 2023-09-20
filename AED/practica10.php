<?php


$numero = 3102;
$resultado = "";
$i = 2;

function descomponer_numero($numADescomponer, $i)
{


    if ($i % 2 != 0) {
        $numADescomponer /= $i;
        descomponer_numero($numADescomponer, $i);

    } else {
        descomponer_numero($numADescomponer, $i + 1);
    }
    return "$i x ";
}

$resulado = descomponer_numero($numero, $i);
echo $resultado;