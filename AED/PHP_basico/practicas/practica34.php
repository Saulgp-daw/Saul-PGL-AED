<?php

    
    $conUrlEncode = urlencode('Pasando datos diría.. que hay que usar urlencode');
    $sinUrlEncode = 'Pasando';
    echo "<a href=practica34.php?prueba=$sinUrlEncode&prueba2=$conUrlEncode</a>";
    $recibido = $_GET["prueba"] ?? "nadita";
    $recibido2 = $_GET["prueba2"] ?? "nadita";
    echo "<h3>se ha recibido:</h3>";
    echo "prueba: ". $recibido . "<br>";
    echo "prueba2: ". $recibido2 . "<br>";

    echo "<br> Foreach: <br>";
    foreach ($_GET as $clave => $valor) {
        echo "Clave: " . $clave . ", Valor: " . $valor . "<br>";
    }
?>