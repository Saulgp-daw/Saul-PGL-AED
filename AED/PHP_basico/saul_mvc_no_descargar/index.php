<?php
    echo "Hola a todos! Soy Saúl<br>";
    $pathToController = $_REQUEST['pathtocontroller'];
    
    $piezas = explode("/", $pathToController);

    print_r($piezas);

    $nombreClase = ucfirst($piezas[0]) . "Controller";
    $nombreFichero = "app/Controller/".$nombreClase.".php";
    echo "<br>Nombre de la clase: ".$nombreClase;
    echo "<br>Nombre del fichero: ".$nombreFichero;
    

    require_once($nombreFichero);

    $nombreClase::balar();

