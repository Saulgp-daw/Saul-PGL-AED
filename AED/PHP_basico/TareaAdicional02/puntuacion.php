<?php include("./alumnos.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Puntuaciones</title>
</head>
<body>
    <?php
        foreach ($alumnos as $alumno) {
            echo "$alumno:". $_GET[$alumno] ."<br>";
        }
    ?>
</body>
</html>