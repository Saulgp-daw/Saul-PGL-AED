<?php include("./alumnos.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emparejamiento</title>
</head>

<body>
    <form action="puntuacion.php" method="get">
        <label for="usuario">Usuario: </label><input type="text" name="usuario" id="usuario"><br>
        <?php



        foreach ($alumnos as $key => $value) {
            echo "<label>$value: </label><input type='number' name='$key' min='0' max='10' pattern='\d*'><br>";
        }
        ?>
        <input type="submit" value="Enviar">
    </form>


</body>

</html>