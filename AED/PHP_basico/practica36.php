<!DOCTYPE html>
<html>
<head>
    <title>Separar Números Impares y Pares</title>
</head>
<body>
    <h1>Separar Números Impares y Pares</h1>

    <?php
    function esImpar($numero) {
        return $numero % 2 !== 0;
    }

    function esPar($numero) {
        return $numero % 2 === 0;
    }

    $input = "";
    $numeros = array();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Si se ha enviado el formulario
        $input = $_POST["input"];

        // Dividimos la cadena en un array de números
        $numeros = explode(" ", $input);

        // Eliminamos espacios en blanco en blanco
        $numeros = array_filter($numeros, 'trim');

        // Ordenamos el array, primero impares y luego pares
        usort($numeros, function($a, $b) {
            if (esImpar($a) && esPar($b)) {
                return -1;
            } elseif (esPar($a) && esImpar($b)) {
                return 1;
            } else {
                return $a - $b;
            }
        });
    }
    ?>

    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="input">Introduce una cadena de números separados por espacios:</label>
        <input type="text" name="input" id="input" value="<?php echo $input; ?>">
        <input type="submit" value="Separar">
    </form>

    <?php
    if (!empty($numeros)) {
        echo "<h2>Números Impares:</h2>";
        foreach ($numeros as $numero) {
            if (esImpar($numero)) {
                echo $numero . "<br>";
            }
        }

        echo "<h2>Números Pares:</h2>";
        foreach ($numeros as $numero) {
            if (esPar($numero)) {
                echo $numero . "<br>";
            }
        }
    }
    ?>
</body>
</html>
