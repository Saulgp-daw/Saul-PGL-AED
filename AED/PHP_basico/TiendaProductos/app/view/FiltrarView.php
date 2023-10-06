<?php

class FiltrarView {
    public function __contruct(){}

    private function cabecera(){
        return '            
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="app/CSS/estiloCatalogo.css">
            <title>Filtrar Producto</title>
            
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
        echo "<h3>-Filtrar un Producto-</h3>";
        echo "<h5>-Filtre por nombre-</h5>";
        echo "<form action='filtrarProducto' method='GET'";
        echo "<label>Nombre: </label><input type='text' name='nombre_producto' required/> ";
        echo "<input type='submit' value='Buscar'>";
        echo "</form>";
        echo $this->enlacesPaginas("Volver");
        echo $this->pie();
    }

    public function detallesProducto($producto){
        echo $this->cabecera();
        echo "<h3>-Detalles del Producto-</h3>";
        echo "Id:". $producto['id'] ."<br>";
        echo "Nombre:". $producto['nombre']."<br>";
        echo "Categoría:". $producto['categoria']."<br>";
        echo "Stock:". $producto['stock']  ."uds. <br>";
        echo "Precio:". $producto['precio']  ."€<br>";
        echo $this->enlacesPaginas("Ir al home")."<br>";
        echo $this->pie();
    }

    private function enlacesPaginas($mensaje){
        return '<a href="../">'. $mensaje .'</a>';
    }


}

?>