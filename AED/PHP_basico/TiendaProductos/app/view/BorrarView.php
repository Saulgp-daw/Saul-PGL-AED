<?php

class BorrarView {
    public function __contruct(){}

    private function cabecera(){
        return '            
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="app/CSS/estiloCatalogo.css">
            <title>Borrar Producto</title>
            
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
        echo "<h3>-Borrar un Producto-</h3>";
        echo "<form action='borrarProducto' method='GET'";
        echo "<label>Id a borrar: </label><input type='text' name='id_producto' required/><br>";
        echo "<input type='submit' value='Enviar'>";
        echo "</form>";
        echo $this->pie();
    }


}

?>