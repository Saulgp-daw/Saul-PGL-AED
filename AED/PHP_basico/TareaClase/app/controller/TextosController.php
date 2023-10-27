<?php 
    require_once("app/model/Anotacion.php");
    require_once("app/controller/GestionarFichero.php");

    class TextosController{

        public static $anotaciones = [];

        function index($args){
            echo "Hola";
        }

        public static function cargarDatos(){
            $gestionarFichero = new GestionarFichero();
            $datos = $gestionarFichero->cargarCSV();

            foreach ($datos as $dato) {
                $datosAutor = explode(";", $dato[0]);

                array_push(self::$anotaciones, $datosAutor);
            }
        }

        function crear( $args ){
            require_once("app/view/CrearView.php");
            $vistaCrear = new CrearView();
            $vistaCrear->body();
        }

        function crearAnotacion($args){
            $autor = $args['autor'];
            $titulo = $args['titulo'];
            $contenido = $args['contenido'];
            $unixtime = time();
            $anotacion = new Anotacion( $autor, $titulo, $contenido, $unixtime );
            $array = array($anotacion->autor, $anotacion->titulo, $anotacion->contenido, $anotacion->fechaActual);

            array_push(self::$anotaciones, $array);

            $gestionarFichero = new GestionarFichero();
            $gestionarFichero->guardarCSV(self::$anotaciones);
            self::crear($args);

        }

        function mostrar( $args ){
            require_once("app/view/MostrarView.php");

            $autor = $args['autor'] ?? "";
            echo $autor;
            $vistaMostrar = new MostrarView();

            if($autor != ""){
                $autores = [];
                foreach (self::$anotaciones as $anotacion) {
                    if(strtolower($anotacion[0]) == strtolower($autor)){
                        array_push($autores, $anotacion);
                    }
                }
                $vistaMostrar->autores($autores);
            }else{
                $vistaMostrar->body(self::$anotaciones);
            }
        }

        function borrar($args){
            require_once("app/view/BorrarView.php");

            $autor = $args['autor'] ?? "";
            echo $autor;
            $vistaBorrar= new BorrarView();

            if($autor != ""){
                $autores = [];
                foreach (self::$anotaciones as $anotacion) {
                    if(strtolower($anotacion[0]) != strtolower($autor)){
                        array_push($autores, $anotacion);
                    }
                }
                self::$anotaciones = $autores;
                $gestionarFichero = new GestionarFichero();
                $gestionarFichero->guardarCSV(self::$anotaciones);
                $vistaBorrar->body();
            }

        }

        

    }

    TextosController::cargarDatos();
