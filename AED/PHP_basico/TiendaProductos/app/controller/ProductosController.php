<?php

    class ProductosController{

        private static $productos = null; //Este va a ser el array con el que lidiaremos con los valores cargados, insertados y los que queremos filtrar y borrar

        /**
         * El index es el método por defecto, comprobará si la vista de catálogo de productos existe y de ser así llamará a la vista con un mensaje u otro o no mostrará nada
         */
        function index($args){
            //echo "Dentro del método por defecto Productos Controller";
            if($this->comprobarFicheroExiste("app/view/ProductosView.php")){
                $vistaCatalogo = new ProductosView();
                $vistaCatalogo->enlacesAVistas();
                if(self::$productos != null){
                    (isset($args['agregado']) && !isset($args['borrado']))? $mensaje = "Producto añadido!" : $mensaje = "Producto borrado!";
                    //(isset($args['borrado']))? $mensaje = "Producto borrado!" : $mensaje="";
                    $vistaCatalogo->mostrar_productos(self::$productos, $mensaje);
                }else{
                    $vistaCatalogo->no_productos();
                }
            }
        }

        /**
         * Este método recogerá los valores del JSON y los decodificará para guardarlos en nuestro atributo array de productos, en caso de no existir el archivo json lo generaremos vacío
         */
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

        /**
         * Mismo caso que cargar solo que a la inversa, encodearemos los datos de nuestro array como JSON para reemplazar el texto del fichero con los nuevos datos
         */
        public static function guardarCatalogoProductos($rutaJSON){
            if(!file_exists($rutaJSON)){
                $archivo = fopen($rutaJSON, 'w');
                fclose($archivo);
            }
            echo "<br>" .json_encode(self::$productos)."<br>";
            file_put_contents($rutaJSON, json_encode(self::$productos));
        }

        /**
         * Esta función solo nos comprobará si la ruta de los ficheros aportada existe, de ser así devolverá un booleano
         * @return bool existe o no el archivo
         */
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

        /**
         * Función que llama a la vista de agregar
         */
        function agregarView($args){
            if($this->comprobarFicheroExiste("app/view/AgregarView.php")){
                $vistaAgregar = new AgregarView();
                $vistaAgregar->body();
            }else{
                echo "No se encuentra dicho archivo";
            }
        }
        /**
         * Función que llama a la vista de borrar
         */

        function borrarView($args){
            if($this->comprobarFicheroExiste("app/view/BorrarView.php")){
                $vistaBorrar = new BorrarView();
                $vistaBorrar->body();
            }else{
                echo "No se encuentra dicho archivo";
            }
        }

        function filtrarView($args){
            if($this->comprobarFicheroExiste("app/view/FiltrarView.php")){
                $vistaFiltrar = new FiltrarView();
                $vistaFiltrar->body();
            }else{
                echo "No se encuentra dicho archivo";
            }
        }

        function filtrarProducto($args){
            $nombre_producto_filtrar =  $args['nombre_producto'] ?? "";
            if($nombre_producto_filtrar != "" && self::comprobarFicheroExiste("app/view/FiltrarView.php")){
                foreach (self::$productos as $key => $producto) {
                    if(strtolower($nombre_producto_filtrar) == strtolower($producto['nombre'])){
                        $vistaFiltrar = new FiltrarView();
                        $vistaFiltrar->detallesProducto($producto);
                    }
                }
            }
        }



        /**
         * Función que recibirá los parámetros del formulario de la vista del agregar producto. Calculamos dentro el código del producto y crearemos un objeto Producto al que luego añadiremos a nuestro array y guardaremos en el JSON
         */
        function agregarProducto($args){
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
                header("Location: /practicas/AED/PHP_basico/TiendaProductos/productos?agregado=true");
                exit;
            }else{
                echo "El fichero no existe!!";
            } 
        }

        /**
         * Función que recibirá los parámetros del formulario de la vista del borrar producto. Hacemos un foreach de nuestro array para verificar que el id recibido/que se desea borrar es el mismo que un objeto de nuestro array para borrarlos y guardaremos en el JSON el array sin él
         */
        function borrarProducto($args){
            $id_producto_borrar =  $args['id_producto'] ?? "";
            if($id_producto_borrar != ""){
                foreach (self::$productos as $key => $producto) {
                    if($id_producto_borrar == $producto['id']){
                        unset(self::$productos[$key]);
                    }
                }
            }
            self::guardarCatalogoProductos("app/model/data.json");

            header("Location: /practicas/AED/PHP_basico/TiendaProductos/productos?borrado=true");
            exit;
            
        }

        

        
    }

    //Nada más iniciar la aplicación llamaremos al método estático para cargar los datos del json que contienen nuestros productos
    ProductosController::cargarCatalogoProductos("app/model/data.json");
?>