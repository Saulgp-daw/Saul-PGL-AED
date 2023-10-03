<?php include("./alumnos.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Puntuaciones</title>
</head>

<body>
    <?php
        $puntuacionUsuarios = null;

    if (file_exists("puntuaciones.txt") && filesize("puntuaciones.txt") != 0) {
        $fichero_puntuaciones = file_get_contents("puntuaciones.txt");
        $puntuacionUsuarios = unserialize($fichero_puntuaciones);
        echo "<br> -------DATOS CARGADOS CORRECTAMENTE-----<br> ";
        echo "Sin serializar: <br> $fichero_puntuaciones";
        echo "<br>-----DATOS DESERIALIZADOS-----<br>";
        print_r($puntuacionUsuarios);
    }

    $usuario = $_GET['encuestado'] ?? "Anónimo";
    echo "<br>$usuario<br>";
    $arrayPuntuacion = [];
   
    foreach ($alumnos as $key => $value) {
        $puntuacion = $_GET[$key] ?? 0;
        $arrayPuntuacion[$key] = $puntuacion;
    }

    echo "<br>---AÑADIENDO SUS VALORES-----<br>";
    $puntuacionUsuarios[$usuario] = $arrayPuntuacion;
    print_r($puntuacionUsuarios);
    $texto = serialize($puntuacionUsuarios);


    file_put_contents("./puntuaciones.txt", $texto);

    foreach ($puntuacionUsuarios as $id => $arrayNotas) {
        $suma = 0;
        foreach ($arrayNotas as $key => $value) {
            echo "<br>$id: ";
            //echo gettype($key);
            echo $arrayNotas[parse_str($id)];
            //busco el $id en el array de $key
            //echo "$key te da $arrayNotas[$posicion]";
            //$puntuacion = $arrayNotas[$id];
            //print_r($arrayNotas);
            echo "<br>";
            //echo "El usuario con id: $id tiene puntuacion de $key es: $puntuacion <br>";
        }
    }

    ?>
</body>

</html>