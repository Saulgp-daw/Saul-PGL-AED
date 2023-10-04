<?php

    class AcertarnumeroController{

        //public static $num_random = self::numero_aleatorio();
        public function __construct(){
            

        }

        public function index($args){
            echo "estamos en método por defecto en AcertarnumeroController <br>";
            if( file_exists('app/view/Formulario.php')){
                require_once('app/view/Formulario.php');
                
            }else{
                echo "el fichero no existe";
            }
        }

        public function saludar($args){
     
            $nombre = $args["nombre"]??"";
            //aquí llamamos al modelo etc

            //llamamos a la vista
            //observar que la ruta relativa se da respecto a index.php
            if( file_exists('app/view/AcertarNumeroView.php')){
                require_once('app/view/AcertarNumeroView.php');
                $vista = new AcertarNumeroView();
                $vista->mostrar([$nombre]);
            }else{
                echo "el fichero no existe";
            }
        }

        public function numero_aleatorio(){
            return random_int(0, 10);
        }

        public function numero_recibido($args){
            $numero = $args["numero"] ?? 0;
            $random = self::numero_aleatorio();

            if( file_exists('app/view/AcertarNumeroView.php')){
                require_once('app/view/AcertarNumeroView.php');
                $vista = new AcertarNumeroView();
            }else{
                echo "el fichero no existe";
            }

            if($random == $numero){
                $vista->dar_acierto($numero);
            }else{
                header("Location: http://localhost:8000/practicas/AED/PHP_basico/acertar_numero/");
            }
        }
    }
    
?>