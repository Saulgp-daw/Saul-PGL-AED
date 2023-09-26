<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Validación de formulario</h2>
    <p>* Campo obligatorio</p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="nombre">Nombre: </label>
        <input type="text" name="nombre" id="nombre"><span> *</span><br>
        <label for="correo">Correo: </label>
        <input type="text" name="correo" id="correo"><span> *</span><br>
        <label for="web">Página web: </label>
        <input type="text" name="web" id="web"><br>
        <label for="comentario">Comentario: </label>
        <textarea name="comentario" id="comentario" cols="30" rows="10"></textarea><br>
        <label for="genero">Género: </label>
        <input type="radio" name="genero" id="genero-hombre" value="hombre" checked> Hombre
        <input type="radio" name="genero" id="genero-mujer" value="mujer" > Mujer
        <input type="radio" name="genero" id="genero-apache" value="apache" > Helicóptero Apache
        <span> *</span><br>
        <input type="submit" value="Enviar">
    </form>

    <?php
    $variables = $_REQUEST;
    // $variables ahora contiene todas las variables GET y POST
    print_r($variables);
    $faltantes = [];
    foreach ($variables as $key => $value) {
        if(isset($_POST[$key]) && !empty($value)){
            echo "isset: ".$value;
        }else{
            array_push($faltantes, $key);
        }
    }

    if(count($faltantes)){
        echo "<p>Debe rellenar los siguientes con información: ";
        foreach($faltantes as $campo){
            echo "$campo, ";
        }
        echo "</p>";
    }else{
        echo "<p>La información está rellenada</p> ";
    }
    ?>
    
</body>
</html>