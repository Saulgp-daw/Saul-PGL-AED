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
            <link rel="stylesheet" href="CSS/estiloCatalogo.css">
            <title>Catálogo</title>
            
        </head>
        <body>
        
        ';
    }

    private function pie(){
        return '
        </body>
        </html>            
        ';
    }

    public function enlacesAVistas(){
        echo "<h1 class='titulo'>Página principal</h1>";
        echo "<div class='contenedor_enlaces'>";
        echo "<a class='enlaces' href='productos/agregarView'>Agregar Producto</a>";
        echo "<a class='enlaces' href='productos/borrarView'>Borrar Producto</a>";
        echo "<a class='enlaces' href='productos/filtrarView'>Filtrar Producto</a>";
        echo "<a class='enlaces' href='#'>Modificar Producto (en proceso)</a>";
        echo "</div>";
    }

    public function mostrar_productos($productos, $mensaje){
        echo $this->cabecera();
        echo "<h3 class='titulo'>-Catálogo de productos-</h3>";
        echo "<div>". $this->mensaje_info($mensaje)."</div>";
        echo "<div class='containerProductos'>";
        
        foreach ($productos as $key => $producto) {
            echo "<div class='fichaProducto'>";
                echo "<h5>Id: ".$producto['id']."</h5>";
                echo "<div class='nombres'>".$producto['nombre']."</div>";
                echo "<div>Categoría: ".$producto['categoria']."</div>";
                echo "<div>Stock: ".$producto['stock']."uds.</div>";
                echo "<div>".$producto['precio']."€</div>";
            echo "</div>";
        }
        echo "</div>";
        echo $this->pie();
    }

    public function mensaje_info($mensaje){
        return "<div style='position: absolute;top: 10px;right: 10px;'>$mensaje</div>";
    }

    public function no_productos(): void{
        echo $this->cabecera();
        echo "<h3>-No hay productos-</h3>";
        echo $this->pie();
    }


}

?>