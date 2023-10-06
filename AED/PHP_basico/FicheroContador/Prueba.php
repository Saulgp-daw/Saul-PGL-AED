<?php
    $valorFichero = file_get_contents("fichero.dat");
    $valorFichero = $valorFichero + 1;
    echo $valorFichero . "\n";
    file_put_contents("fichero.dat", $valorFichero);


?>