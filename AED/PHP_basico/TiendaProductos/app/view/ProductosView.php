<?php

class ProductosView {
    public function __construct(){}

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

    public function enlacesAVistas(){
        echo "<br><a href='productos/agregarView'>Agregar Producto</a>";
        echo "<br><a href='productos/borrarView'>Borrar Producto</a>";
    }

    public function mostrar_productos($productos, $mensaje){
        echo $this->cabecera();
        echo "<h3>-Catálogo de productos-</h3>";
        echo "<div style='position: absolute;top: 10px;right: 10px;'>$mensaje</div>";
        echo "<div class='containerProductos'>";
        foreach ($productos as $key => $producto) {
            echo "<div class='fichaProducto'>";
            echo "<div>".$producto['id']."</div>";
            echo "<div>".$producto['nombre']."</div>";
            echo "<div>Categoría: ".$producto['categoria']."</div>";
            echo "<div>Stock: ".$producto['stock']."uds.</div>";
            echo "<div>".$producto['precio']."€</div>";
            echo "</div>";
            echo "<br>-----------------------------";
        }
        echo "</div>";
        echo $this->pie();
    }

    public function no_productos(): void{
        echo $this->cabecera();
        echo "<h3>-No hay productos-</h3>";
        echo $this->pie();
    }


}

?>