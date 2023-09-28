<?php

    class PersonasController{

        public function __construct(){

        }

        public function index($args){
            echo "estamos en método por defecto en PersonasController <br>";
        }

        public function saludar($args){
     
            $nombre = $args["nombre"]??"";
            //aquí llamamos al modelo etc

            //llamamos a la vista
            //observar que la ruta relativa se da respecto a index.php
            if( file_exists('app/view/PersonaView.php')){
                require_once('app/view/PersonaView.php');
                $vista = new PersonaView();
                $vista->mostrar([$nombre]);
            }else{
                echo "el fichero no existe";
            }
        }

    }
    
?>