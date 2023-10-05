<?php

class ProductosView {
    public function __contruct(){}

    private function cabecera(){
        return '            
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="app/CSS/estiloCatalogo.css">
            <title>Catálogo</title>
            
        </head>
        <body>';
    }

    private function pie(){
        return '
        </body>
        </html>            
        ';
    }

    public function mostrar_productos($productos){
        echo $this->cabecera();
        echo "<h3>-Catálogo de productos-</h3>";
        echo "<div class='containerProductos'>";
        foreach ($productos as $key => $producto) {
            echo "<div class='fichaProducto'>";
            echo "<h5>ID: $key</h5> ";
            echo "<div>".$producto['nombre']."</div>";
            echo "<div>Categoría: ".$producto['categoria']."</div>";
            echo "<div>Stock: ".$producto['stock']."uds.</div>";
            echo "<div>".$producto['precio']."€</div>";
            echo "</div>";
        }
        echo "</div>";
        echo $this->pie();
    }


}

?>