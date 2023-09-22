<?

    $GLOBALS['PULGADA'] = 10;

    /*const PULGADA = 2.53;
    echo "Pulgada sin modificar: " . PULGADA;

    const PULGADA = 7;

    echo "Pulgada después de modificar: " . PULGADA;
    const PULGADA = 8;

    echo "Pulgada después de modificar por segunda vez: " . PULGADA;

    $PULGADA = 9;

    echo "Pulgada como variable \$PULGADA: " . PULGADA;*/
    echo $PULGADA;

    function modificar_pulgada(){
        //const PULGADA = 10; //No se puede crear const dentro de una función, da error de sintaxis
        echo $PULGADA; //El programa se queja de que estamos haciendo uso de una variable no está asignada
    }
    

    modificar_pulgada();