<?php
 declare( strict_types=1);
?>
<!DOCTYPE html>
<html>
<head>
 <meta charset="UTF-8">
 <title></title>
 </head>
    <body>
        <?php
        //No da error porque solo retornamos la variable $b
        function fun( int $a, int $b): int {
            $a = "o";
            //La función requiere que se devuelva un entero por lo que al retornar $a hay conflicto de tipado
            return $a;
            //return $b ;
        }
        //print fun(1,2);

        //Da error porque espera que ambos parámetros sean de tipo entero
        print fun("e",3);
        echo "</p>"
        ?>
    </body>
</html>