<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        } else {
            $archivo = fopen($ruta, 'w');
            fclose($archivo);
            $existe = true;
        }
        return $existe;
    }

    /**
     * @var $ruta string
     */
    public function cargarCatalogoProductos($ruta)
    {
        $productos = [];
        if (file_exists($ruta) && filesize($ruta) != 0) {
            $fichero = fopen($ruta, "r");
            if (flock($fichero, LOCK_EX)) {
                rewind($fichero);
                $contenidoJSON = fread($fichero, filesize($ruta));
                flock($fichero, LOCK_UN);
                fclose($fichero);
                $productos = json_decode($contenidoJSON, true);
            } else {
                echo "El archivo está siendo usado actualmente";
                return false;
            }
        } else {
            $archivo = fopen($ruta, 'w');
            fclose($archivo);
        }
        return $productos;
    }

    public function guardarDatosUsuarioFichero($ruta, $arrayDatos)
    {
        if (($open = fopen($ruta, 'a')) !== false) {
            $open = fopen($ruta, 'a');
            foreach ($arrayDatos as $datos) {
                fputcsv($open, $datos);
            }
            fclose($open);
        }
    }

    public function comprobarUsuarioExiste($ruta, $nombre){
        if(self::comprobarFicheroExiste($ruta)){
            $usuarios = self::obtenerUsuarios($ruta);
            $existe = false;
            foreach ($usuarios as $usuario) {
                if(in_array( $nombre, $usuario)) {
                    $existe = true;
                }
            }
        }
        return $existe;
    }

    public function obtenerUsuarios($ruta){
        $usuarios = [];
        if(self::comprobarFicheroExiste($ruta)){
            if($open = fopen($ruta, 'r')){
                while(($data = fgetcsv($open,1000,',')) !== false) {
                    $usuarios[] = $data;
                }
                fclose($open);
            }
        }
        return $usuarios;
    }
}
