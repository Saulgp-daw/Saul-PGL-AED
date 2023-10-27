<?php

class MostrarView {
    public function __contruct(){}

    private function cabecera(){
        return '            
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="CSS/estiloCatalogo.css">
            <title>Mostrar Anotaciones</title>
            
        </head>
        <body>';
    }

    private function pie(){
        return '
        </body>
        </html>            
        ';
    }

    public function body($anotaciones){
        echo $this->cabecera();
        echo "<h3 class='titulo'>-Mostrar Anotaciones-</h3>";
        
        foreach ($anotaciones as $anotacion) {
            $autor = $anotacion[0];
            $titulo = $anotacion[1];
            $contenido = $anotacion[2];
            $fecha = $anotacion[3];

            echo "Autor: ".$autor ."<br>";
            echo "titulo: ".$titulo."<br>";
            echo "contenido: ".$contenido."<br>";
            echo "fecha: ".date('Y-m-d H:i:s', $fecha)."<br>";
            echo "<br><br>";
        }
        echo "<br>".$this->enlacesPaginas("Volver");
        echo $this->pie();
    }

    public function autores($anotaciones){
        echo $this->cabecera();
        echo "<h3 class='titulo'>-Mostrar Autores-</h3>";
        
        foreach ($anotaciones as $anotacion) {
            $autor = $anotacion[0];
            $titulo = $anotacion[1];
            $contenido = $anotacion[2];
            $fecha = $anotacion[3];

            echo "Autor: ".$autor ."<br>";
            echo "titulo: ".$titulo."<br>";
            echo "contenido: ".$contenido."<br>";
            echo "fecha: ".date('Y-m-d H:i:s', $fecha)."<br>";
            echo "<br><br>";
        }
        echo "<br>".$this->enlacesPaginas("Volver");
        echo $this->pie();
    }

    private function enlacesPaginas($mensaje){
        return '<a href="../">'. $mensaje .'</a>';
    }


}

?>