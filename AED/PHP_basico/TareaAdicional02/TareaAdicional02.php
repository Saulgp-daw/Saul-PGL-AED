<?php include("./alumnos.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emparejamiento</title>
</head>
<body>
    <form action="puntuacion.php" method="get">
        <?php 
            

            foreach($alumnos as $alumno){
                echo "<label>$alumno: </label><input type='number' name='$alumno' min='0' max='10' pattern='\d*'><br>";
            }
        ?>
        <input type="submit" value="Enviar">
    </form>

   
</body>
</html>

