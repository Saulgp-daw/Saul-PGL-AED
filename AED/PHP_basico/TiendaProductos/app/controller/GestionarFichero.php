<?php
class GestionarFichero
{

    /**
     * @var $ruta string
     */
    public static function comprobarFicheroExiste($ruta): bool
    {
        $existe = false;
        if (file_exists($ruta)) {
            $existe = true;
            require_once($ruta);
        } else {
            echo "el fichero no existe";
        }
        return $existe;
    }

    /**
     * @var $rutaJSON string
     */
    public function cargarCatalogoProductos($rutaJSON){
        $productos = [];
        if(file_exists($rutaJSON) && filesize($rutaJSON) != 0){
            $fichero = fopen($rutaJSON, "r");
            if(flock($fichero, LOCK_EX)){
                rewind($fichero);
                $contenidoJSON = fread($fichero, filesize($rutaJSON));   
                flock($fichero, LOCK_UN);
                fclose($fichero);
                $productos = json_decode($contenidoJSON, true);
            }else{
                echo "El archivo está siendo usado actualmente";
                return false;
            }
        }else{
            $archivo = fopen($rutaJSON, 'w');
            fclose($archivo);
        }
        return $productos;
    }

    public function guardarCatalogoProductos($rutaJSON, $productos){
        $guardadoDatos = false;
        if(file_exists($rutaJSON)){
            $fichero = fopen($rutaJSON, 'w');
            if(flock($fichero, LOCK_EX)){
                rewind($fichero);
                fwrite($fichero, json_encode($productos, true));   
                flock($fichero, LOCK_UN);
            }
            fclose($fichero);
            $guardadoDatos = true;
        }else{
            $fichero = fopen($rutaJSON, 'w');
            fclose($fichero);
        }
        return $guardadoDatos;
    }
}
