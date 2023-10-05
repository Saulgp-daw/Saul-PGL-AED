<?php
   

    class ProductosController{

        private static $productos = null;

        function index($args){
            echo "Dentro del método por defecto Productos Controller";
            if($this->comprobarFicheroExiste("app/view/ProductosView.php")){
                    $vistaCatalogo = new ProductosView();
                    $vistaCatalogo->mostrar_productos(self::$productos);
            }
        }

        public static function cargarCatalogoProductos($rutaJSON){
            if(file_exists($rutaJSON) && filesize($rutaJSON) != 0){
                $contenidoJSON = file_get_contents($rutaJSON);
                $datosJSON = json_decode($contenidoJSON, true);
                $productosJSON = $datosJSON['productos'];
                self::$productos = $productosJSON;
            }else{
                if(file_put_contents($rutaJSON, "{}")){
                    echo 'Archivo JSON vacío creado con éxito.';
                }else{
                    echo 'No se pudo crear el archivo JSON vacío.';
                }
            }
        }

        function comprobarFicheroExiste($nombreFichero): bool{
            $existe = false;
            if( file_exists($nombreFichero)){
                $existe = true;
                $infoArchivo = pathinfo($nombreFichero);
                // Obtiene la extensión del archivo
                $extension = $infoArchivo['extension'];
                if($extension != "json"){
                    require_once($nombreFichero);
                }
            }else{
                echo "el fichero no existe";
            }
            return $existe;
        }

        function agregarView(){
            if($this->comprobarFicheroExiste("app/view/AgregarView.php")){
                $vistaAgregar = new AgregarView();
                $vistaAgregar->body();
            }else{
                echo "No se encuentra dicho archivo";
            }
        }

        function agregarProducto($args){
            print_r($args);
        }
    }

    ProductosController::cargarCatalogoProductos("app/model/data.json");
?>