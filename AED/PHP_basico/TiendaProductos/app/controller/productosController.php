<?php

    class ProductosController{

        private static $productos = null;

        function index($args){
            echo "Dentro del método por defecto Productos Controller";
            if($this->comprobarFicheroExiste("app/view/ProductosView.php")){
                $vistaCatalogo = new ProductosView();
                $vistaCatalogo->enlacesAVistas();
                if(self::$productos != null){
                    $vistaCatalogo->mostrar_productos(self::$productos);
                }else{
                    $vistaCatalogo->no_productos();
                }
            }
        }

        public static function cargarCatalogoProductos($rutaJSON){
            if(file_exists($rutaJSON) && filesize($rutaJSON) != 0){
                $contenidoJSON = file_get_contents($rutaJSON);
                $datosJSON = json_decode($contenidoJSON, true);
                $productosJSON = $datosJSON;
                self::$productos = $productosJSON;
            }else{
                /*if(file_put_contents($rutaJSON, "")){
                    echo 'Archivo JSON vacío creado con éxito.';
                }else{
                    echo 'No se pudo crear el archivo JSON vacío.';
                }*/

                $archivo = fopen($rutaJSON, 'w');
                fclose($archivo);
            }
        }

        public static function guardarCatalogoProductos($rutaJSON){
            if(!file_exists($rutaJSON)){
                $archivo = fopen($rutaJSON, 'w');
                fclose($archivo);
            }
            echo "<br>" .json_encode(self::$productos)."<br>";
            file_put_contents($rutaJSON, json_encode(self::$productos));
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
            echo $args['nombre_producto'] . "<br>";
            echo $args['categoria_producto'] . "<br>";
            echo $args['stock_producto'] . "<br>";
            echo $args['precio_producto'] . "<br>";

            if($this->comprobarFicheroExiste("app/model/Producto.php")){
                if(self::$productos != null){
                    $idProd = "prod0" . (intval(sizeof(self::$productos))+1);
                }else{
                    $idProd = "prod01";
                    self::$productos = [];
                }
                $prodNuevo = new Producto($idProd, $args['nombre_producto'], $args['categoria_producto'], $args['stock_producto'],  $args['precio_producto']);
                //$prodJSON =  json_encode($prodNuevo);
                //print_r(self::$productos);
                array_push(self::$productos, $prodNuevo);
                //print_r(self::$productos);
                //echo "<br>" .json_encode(self::$productos);
                self::guardarCatalogoProductos("app/model/data.json");
                header("Location: index");
                exit;
            }else{
                echo "El fichero no existe!!";
            }
            
        }

        
    }

    ProductosController::cargarCatalogoProductos("app/model/data.json");
?>