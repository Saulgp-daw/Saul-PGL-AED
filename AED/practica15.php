<?php
    $array = [];
    $array[2]="mensaje";
    $array[7]="lalala!";
    $array[]="yepa yepa!!";
    var_dump($array);

    //no se muestran las posiciones a las que no se les ha asignado ningún valor
    echo "<br>";
    $array2 = array();
    $array2[2] = "Mensaje 2";
    var_dump($array2);
    $array2[7] = "lalalla!2";
    var_dump($array2);
    $array2[] = "yepa yepa2!";
    var_dump($array2);
    //Se muestra lo mismo con y sin corchetes, un var dump por cada inserción mostrará los elementos
    //introducidos hasta el momento
 ?>
