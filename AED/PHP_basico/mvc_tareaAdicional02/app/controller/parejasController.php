<?php include("../model/alumnos.php"); ?>

<?php
class ParejasController
{
    public $puntuacionUsuarios = [];
    public $arrayPuntosParejas = [];
    public $parejasFinales = [];
    

    function guardarComprobarFichero()
    {
        if (file_exists("puntuaciones.txt") && filesize("puntuaciones.txt") != 0) {
            $fichero_puntuaciones = file_get_contents("puntuaciones.txt");
            $this->puntuacionUsuarios = unserialize($fichero_puntuaciones);
        }
        //print_r($this->puntuacionUsuarios);

        $usuario = $_GET['encuestado'] ?? "Anónimo";
        $arrayPuntuacion = [];
        $alumnos = Alumnos::devolverArrayAlumnos();

        foreach ($alumnos as $key => $value) {
            $puntuacion = $_GET[$key] ?? 0;
            $arrayPuntuacion[$key] = $puntuacion;
        }

        $this->puntuacionUsuarios[$usuario] = $arrayPuntuacion;
        $texto = serialize($this->puntuacionUsuarios);

        //print_r($arrayPuntuacion);
        //print_r($this->puntuacionUsuarios);
        file_put_contents("./puntuaciones.txt", $texto);
    }

    function sumatorioParejas(){
        foreach ($this->puntuacionUsuarios as $id => $arrayNotas) {
            $suma = 0;
            $ningunCompi = true;
            foreach ($arrayNotas as $id2 => $puntos) {

                if ($puntos > 0) {
                    $ningunCompi = false;
                }

                if (array_key_exists($id2, $this->puntuacionUsuarios)) {
                    if ($id < $id2) {
                        $suma = intval($this->puntuacionUsuarios[$id][$id2]) + intval($this->puntuacionUsuarios[$id2][$id]);
                        $this->arrayPuntosParejas["$id/" . $id2] = $suma;

                    }
                }
            }

            if ($ningunCompi) {
                $this->arrayPuntosParejas["$id/" . $id] = 100;
            }
        }
        arsort($this->arrayPuntosParejas);
        //print_r($this->arrayPuntosParejas);
    }

    function DarParejasFinales(){
        foreach ($this->arrayPuntosParejas as $idCombinado => $SumaPuntuacion) {
            $ids = explode("/", $idCombinado);
            $id1 = $ids[0];
            $id2 = $ids[1];
        
            if (!isset($this->parejasFinales[$id1]) && !isset($this->parejasFinales[$id2])) {
                $this->parejasFinales[$id1] = $id2;
                $this->parejasFinales[$id2] = $id1;
            }
        
        }
        return $this->parejasFinales;
    }
}

$parejas = new ParejasController();
$parejas->guardarComprobarFichero();
$parejas->sumatorioParejas();


?>