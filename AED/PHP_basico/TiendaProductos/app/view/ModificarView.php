<?php

class ModificarView {
    public function __contruct(){}

    private function cabecera(){
        return '            
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="CSS/estiloCatalogo.css">
            <title>Modificar Producto</title>
            
        </head>
        <body>';
    }

    private function pie(){
        return '
        </body>
        </html>            
        ';
    }

    public function body(){
        echo $this->cabecera();
        echo "<h3 class='titulo'>-Modificar Producto-</h3>";
        echo "<form action='modificarProducto' method='GET'";
        echo "<label>Id: </label><input type='text' name='id_producto' required/><br>";
        echo "<label>Nombre: </label><input type='text' name='nombre_producto' required/><br>";
        echo "<label>Categoria: </label><input type='text' name='categoria_producto' required/><br>";
        echo "<label>Stock: </label><input type='number' name='stock_producto' step='1' required/><br>";
        echo "<label>Precio: </label><input type='number' name='precio_producto' step='any' required/><br>";
        echo "<input type='submit' value='Enviar'>";
        echo "</form>";
        echo "<br>".$this->enlacesPaginas("Volver");
        echo $this->pie();
    }

    private function enlacesPaginas($mensaje){
        return '<a href="../">'. $mensaje .'</a>';
    }


}

?>