<?php


    class PersonaView{

        public function __construct(){}
        
        private function cabecera(){
            return '            
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Document</title>
                
            </head>
            <body>';
        }

        private function pie(){
            return '
            </body>
            </html>            
            ';
        }

        public function mostrar($datos){
            echo $this->cabecera();
            echo "Se ha recibido:<br>";
            echo "<table>";
            foreach($datos as $key=>$value){
                echo "<tr>";
                echo "<td>";
                echo "clave: ".$key." valor: ".$value;
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";            
            echo $this->pie();
            
        }
    }
?>


