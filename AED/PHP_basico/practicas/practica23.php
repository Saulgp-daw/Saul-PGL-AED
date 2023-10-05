<?php
    echo "<table border='1px'>";
    echo "<tr><th>Nombre de la variable</th><th>Valor</th></tr>";
    foreach ($_SERVER as $key => $value) {
        echo "<tr>";
        echo "<td> $key </td><td>$value</td>";
        echo "</tr>";
    }
    echo "</table>";
