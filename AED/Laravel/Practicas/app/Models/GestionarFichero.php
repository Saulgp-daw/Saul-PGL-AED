<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GestionarFichero extends Model
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

    public function credencialesCorrectas($ruta, $nombre, $password){
        if(self::comprobarFicheroExiste($ruta)){
            $usuarios = self::obtenerUsuarios($ruta);
            $credencialesCorrectas = false;
            foreach ($usuarios as $usuario) {
               if($usuario[0] == $nombre && $usuario[1] == $password) {
                $credencialesCorrectas = true;
               }
            }
        }
        return $credencialesCorrectas;
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
