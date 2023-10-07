<?php
require_once("app/controller/GestionarFichero.php");

class ProductosController
{

    private static $productos = null; //Este va a ser el array con el que lidiaremos con los valores cargados, insertados y los que queremos filtrar y borrar
    private static $rutaJSON = "app/model/data.json";

    public static function devolverRutaJSON()
    {
        return self::$rutaJSON;
    }

    /**
     * El index es el método por defecto, comprobará si la vista de catálogo de productos existe y de ser así llamará a la vista con un mensaje u otro o no mostrará nada
     */
    function index($args)
    {
        //echo "Dentro del método por defecto Productos Controller";

        if (GestionarFichero::comprobarFicheroExiste("app/view/ProductosView.php")) {
            $vistaCatalogo = new ProductosView();
            $vistaCatalogo->enlacesAVistas();
            if (self::$productos != null) {
                $mensaje = "";
                if (isset($args['agregado'])) {
                    $mensaje = "Producto añadido correctamente";
                }
                if (isset($args['borrado'])) {
                    $mensaje = "Producto borrado correctamente";
                }

                //(isset($args['borrado']))? $mensaje = "Producto borrado!" : $mensaje="";
                $vistaCatalogo->mostrar_productos(self::$productos, $mensaje);
            } else {
                $vistaCatalogo->no_productos();
            }
        }
    }

    function obtenerCarpetaRaiz(): string
    {
        $rutaRelativa = str_replace($_SERVER['DOCUMENT_ROOT'], '', $_SERVER['SCRIPT_FILENAME']);
        $partesRuta = explode('/', $rutaRelativa);
        $nombreCarpetaRaiz = $partesRuta[1];
        return $nombreCarpetaRaiz;
    }

    /**
     * Este método recogerá los valores del JSON y los decodificará para guardarlos en nuestro atributo array de productos, en caso de no existir el archivo json lo generaremos vacío
     */
    public static function cargarCatalogoProductos()
    {
        $gestionarFichero = new GestionarFichero();
        $datos = $gestionarFichero->cargarCatalogoProductos(self::devolverRutaJSON());
        if ($datos) {
            self::$productos = $datos;
        }
    }

    /**
     * Mismo caso que cargar solo que a la inversa, encodearemos los datos de nuestro array como JSON para reemplazar el texto del fichero con los nuevos datos
     */
    public static function guardarCatalogoProductos()
    {
        $gestionarFichero = new GestionarFichero();
        $guardadoDatos = $gestionarFichero->guardarCatalogoProductos(self::$rutaJSON, self::$productos);
        if (!$guardadoDatos) {
            echo "<br>Datos no guardados";
            die("Los datos deben de no haberse guardado");
        }
    }

    /**
     * Esta función solo nos comprobará si la ruta de los ficheros aportada existe, de ser así devolverá un booleano
     * @return bool existe o no el archivo
     */
    function comprobarFicheroExiste($nombreFichero): bool
    {
        $existe = false;
        if (file_exists($nombreFichero)) {
            $existe = true;
            $infoArchivo = pathinfo($nombreFichero);
            // Obtiene la extensión del archivo
            $extension = $infoArchivo['extension'];
            if ($extension != "json") {
                require_once($nombreFichero);
            }
        } else {
            echo "el fichero no existe";
        }
        return $existe;
    }

    /**
     * Función que llama a la vista de agregar
     */
    function agregarView($args)
    {
        if (GestionarFichero::comprobarFicheroExiste("app/view/AgregarView.php")) {
            $vistaAgregar = new AgregarView();
            $vistaAgregar->body();
        } else {
            echo "No se encuentra dicho archivo";
        }
    }
    /**
     * Función que llama a la vista de borrar
     */

    function borrarView($args)
    {
        if (GestionarFichero::comprobarFicheroExiste("app/view/BorrarView.php")) {
            $vistaBorrar = new BorrarView();
            $vistaBorrar->body();
        } else {
            echo "No se encuentra dicho archivo";
        }
    }

    function filtrarView($args)
    {
        if (GestionarFichero::comprobarFicheroExiste("app/view/FiltrarView.php")) {
            $vistaFiltrar = new FiltrarView();
            $encontrado =  $args['no_encontrado'] ?? "";
            $mensaje = "";
            if (isset($args['no_encontrado'])) {
                $mensaje = "Producto no encontrado";
            }
            $vistaFiltrar->body($mensaje);
        } else {
            echo "No se encuentra dicho archivo";
        }
    }

    function modificarView($args)
    {
        if (GestionarFichero::comprobarFicheroExiste("app/view/ModificarView.php")) {
            $vistaModificar = new ModificarView();
            $vistaModificar->body();
        } else {
            echo "No se encuentra dicho archivo";
        }
    }

    function modificarProducto($args)
    {
        print_r($args);
        if (GestionarFichero::comprobarFicheroExiste("app/model/Producto.php")) {
            $prodMod = new Producto($args['id_producto'], $args['nombre_producto'], $args['categoria_producto'], $args['stock_producto'],  $args['precio_producto']);
            if (self::comprobarIdExiste($prodMod->id)) {
                self::borrarProducto($args, $prodMod->id);
                self::agregarProducto($args, $prodMod);
            } else {
                echo "El id no existe";
            }
        }
    }

    function comprobarIdExiste($idModificar)
    {
        $existe = false;
        foreach (self::$productos as $key => $producto) {
            if ($producto['id'] == $idModificar) {
                $existe = true;
            }
        }
        return $existe;
    }

    /**
     * Función que recibirá los parámetros del formulario de la vista del agregar producto. Calculamos dentro el código del producto y crearemos un objeto Producto al que luego añadiremos a nuestro array y guardaremos en el JSON
     */
    function agregarProducto($args, $prodMod = null)
    {
        if (GestionarFichero::comprobarFicheroExiste("app/model/Producto.php")) {
            if (self::$productos != null) {
                $ultimoProd = end(self::$productos);
                print_r($ultimoProd);
                $separacionId = explode("prod0", $ultimoProd["id"]);
                $idProd = "prod0" . (intval($separacionId[1]) + 1);
                echo $idProd;
                //$idProd = "prod0" . (intval(sizeof(self::$productos)) + 1);
            } else {
                $idProd = "prod01";
                self::$productos = [];
            }

            $prodNuevo = new Producto($idProd, $args['nombre_producto'], $args['categoria_producto'], $args['stock_producto'],  $args['precio_producto']);
            if ($prodMod != null) {
                $prodNuevo = $prodMod;
            }
            array_push(self::$productos, $prodNuevo);
            self::guardarCatalogoProductos();
            header("Location: /" . $this->obtenerCarpetaRaiz() . "/AED/PHP_basico/TiendaProductos/productos?agregado=true");
            exit;
        } else {
            echo "El fichero no existe!!";
        }
    }

    function filtrarProducto($args)
    {
        $nombre_producto_filtrar =  $args['nombre_producto'] ?? "";
        $encontrado = false;
        if ($nombre_producto_filtrar != "" && GestionarFichero::comprobarFicheroExiste("app/view/FiltrarView.php")) {
            $vistaFiltrar = new FiltrarView();
            foreach (self::$productos as $key => $producto) {
                if (strtolower($nombre_producto_filtrar) == strtolower($producto['nombre'])) {
                    $vistaFiltrar->detallesProducto($producto);
                    $encontrado = true;
                }
            }
            if (!$encontrado) {
                header("Location: /" . $this->obtenerCarpetaRaiz() . "/AED/PHP_basico/TiendaProductos/productos/filtrarView?no_encontrado=false");
            }
        }
    }





    /**
     * Función que recibirá los parámetros del formulario de la vista del borrar producto. Hacemos un foreach de nuestro array para verificar que el id recibido/que se desea borrar es el mismo que un objeto de nuestro array para borrarlos y guardaremos en el JSON el array sin él
     */
    function borrarProducto($args, $idMod=null)
    {
        $id_producto_borrar =  $args['id_producto'] ?? "";
        $borrado = false;
        $modificado = false;
        if ($id_producto_borrar != "") {
            foreach (self::$productos as $key => $producto) {
                if ($id_producto_borrar == $producto['id']) {
                    unset(self::$productos[$key]);
                    if($idMod == null){
                        $borrado = true;
                    }else{
                        $modificado = true;
                    }
                    
                }
            }
        }
        self::guardarCatalogoProductos();
        $mensaje = "";
        if ($borrado) {
            $mensaje = "?borrado=true";
            header("Location: /" . $this->obtenerCarpetaRaiz() . "/AED/PHP_basico/TiendaProductos/productos" . $mensaje);
            exit;
        }else if($modificado){
            $mensaje = "?modificado=true";
        }else{
            header("Location: /" . $this->obtenerCarpetaRaiz() . "/AED/PHP_basico/TiendaProductos/productos" . $mensaje);
        }
       
    }
}

//Nada más iniciar la aplicación llamaremos al método estático para cargar los datos del json que contienen nuestros productos
ProductosController::cargarCatalogoProductos();
