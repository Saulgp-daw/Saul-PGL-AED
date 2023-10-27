<?php

class CrearView {
    public function __contruct(){}

    private function cabecera(){
        return '            
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="CSS/estiloCatalogo.css">
            <title>Crear Anotacion</title>
            
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
        echo "<h3 class='titulo'>-Crear Anotacion-</h3>";
        echo "<form action='crearAnotacion' method='GET'";
        echo "<label>Autor: </label><input type='text' name='autor' required/><br>";
        echo "<label>Titulo: </label><input type='text' name='titulo' required/><br>";
        echo "<textarea name='contenido' id='contenido' cols='30' rows='10'></textarea>";
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