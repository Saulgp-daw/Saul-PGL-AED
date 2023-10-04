<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h4>Acierta un número del 0 al 10 ambos inclusive</h4>
    <form action="acertarnumero/numero_recibido" method="get">
        <label for="numero">Tu numero: </label>
        <input type="number" name="numero" id="numero"><br>
        <input type="submit" value="Enviar">

    </form>

</body>

</html>

<?php
    class Formulario{
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

        
    }



?>

