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

    $arrayPuntosParejas = [];

    foreach ($puntuacionUsuarios as $id => $arrayNotas) {
        $suma = 0;
        $ningunCompi = true;
        foreach ($arrayNotas as $id2 => $puntos) {

            if($puntos > 0){
                $ningunCompi  = false;
            }

            if(array_key_exists($id2, $puntuacionUsuarios) ){
                if($id < $id2){
                    $suma = intval($puntuacionUsuarios[$id][$id2]) + intval($puntuacionUsuarios[$id2][$id]);
                    $arrayPuntosParejas["$id/".$id2] = $suma;
                }
            }
        }
        
        if($ningunCompi){
            $arrayPuntosParejas["$id/".$id] = 100;
        }

    }
    
    arsort($arrayPuntosParejas);
    print_r($arrayPuntosParejas);
    $parejasFinales = [];
    foreach ($arrayPuntosParejas as $idCombinado => $SumaPuntuacion) {
        $ids = explode("/", $idCombinado);
        $id1 = $ids[0];
        $id2 = $ids[1];

        if(!isset($parejasFinales[$id1]) && !isset($parejasFinales[$id2])){
            $parejasFinales[$id1]  = $id2;
            $parejasFinales[$id2]  = $id1;
        }  

    }

    echo "<br>Parejas finales: <br>";
    print_r($parejasFinales);

    ?>
</body>

</html>