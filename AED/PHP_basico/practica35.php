<!DOCTYPE html>
<html>
<head>
    <title>Tabla de Multiplicar</title>
</head>
<body>
    <h1>Tabla de Multiplicar</h1>

    <?php
    $numero = ""; // Inicializamos la variable número

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Si se ha enviado el formulario
        $numero = $_POST["numero"];

        if (is_numeric($numero) && is_int($numero + 0) && $numero > 0) {
            // Verificamos que $numero sea un número entero positivo
            echo "<h2>Tabla de multiplicar del número $numero</h2>";
            echo "<table border='1'>";
            for ($i = 1; $i <= 10; $i++) {
                $resultado = $numero * $i;
                echo "<tr><td>$numero x $i</td><td>$resultado</td></tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Por favor, introduce un número entero positivo válido.</p>";
        }
    }
    ?>

    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="numero">Introduce un número entero positivo:</label>
        <input type="text" name="numero" id="numero" value="<?php echo $numero; ?>">
        <input type="submit" value="Mostrar Tabla">
    </form>
</body>
</html>
