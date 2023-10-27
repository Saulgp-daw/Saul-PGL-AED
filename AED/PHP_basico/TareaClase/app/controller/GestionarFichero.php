<?php
require_once("app/model/Anotacion.php");
class GestionarFichero
{



    public function guardarCSV($anotaciones)
    {
        if (file_exists("app/model/anotaciones.csv")) {
            $fichero = fopen("app/model/anotaciones.csv", 'w');
            print_r($anotaciones);
            foreach ($anotaciones as $anotacion) {
                fputcsv($fichero, $anotacion, ";");
            }
            fclose( $fichero);
        }
    }

    public function cargarCSV()
    {
        $contenido = [];
        if (($open = fopen("app/model/anotaciones.csv", "r")) !== FALSE) {

            while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {
                $contenido[] = $data;
            }
            fclose($open);
            return $contenido;
        }
    }
}
