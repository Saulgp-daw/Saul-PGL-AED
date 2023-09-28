<?php
class Router
{

    //especificar el nombre del objeto controlador por defecto
    private static $defaultcontroller = "personas";

    public static function init()
    {
        $pathArray = self::getUrl();
        
        //si no hay ruta. Establecemos el controlador por defecto
        $pathArray= $pathArray ?? [self::$defaultcontroller];
        
        
        $nombreController = $pathArray[0];

        //la idea es hacer un match entre el nombre del objeto que se quiere controlar y su
        //controller. Así la ruta nombreapp/personas debe ser atendida por PersonasController.php
        //todos los controller siguen el patrón: NombreobjetocontroladoController.php
        $nombreController = strtolower($nombreController);//texto en minúsculas
        $nombreController = ucfirst($nombreController); //pasa a mayúscula primera letra
        $nombreController = $nombreController."Controller"; 
        
        //por defecto lanzamos el método index() del controller
        $method = $pathArray[1]??"index";
        
        $nombreFicheroController = "app/controller/$nombreController".".php";
        if( !file_exists($nombreFicheroController)){
            echo "ruta no válida";
            die();
        }



        include_once $nombreFicheroController;
        $controller = null;

        if(class_exists($nombreController))
            $controller = new $nombreController;
        else{
            echo "clase no válida";
            die();
        }

        

        //construimos la información que le vamos a pasar al controller
        //primero reconstruimos el subpath
        $extraPath = "";
        $delimiter="";
        for( $i=2;$i<count($pathArray);$i++){
            $extraPath .= $delimiter.$pathArray[$i];
            $delimiter = "/";
        }
        $methodAllParameters = [$extraPath];

        


        //ahora se agrega el resto de parámetros de request
        foreach($_REQUEST as $key => $value){
            if($key != "pathtocontroller"){
                $methodAllParameters[$key]=$value;
            }
        }

        

        
        //podemos llamar el método de un objeto
        //mediante call_user_func_array() Donde el primer argumento
        //es un array con el objeto y el método deseados
        //el segundo argumento es un array con los parámetros para el método
        //como php8 exige que el nombre de los argumentos recibidos en las 
        //funciones sea coincidente con el enviado Vamos a enviar siempre
        //un parámetro: args que será recibido en todos los métodos
        //el primer dato en args será siempre el subpath de la request
        call_user_func_array([$controller, $method], ["args"=>$methodAllParameters]);

     


        
    }


    public static function getUrl()
    {
   

        if(isset($_REQUEST['pathtocontroller']))
        {
        $path = rtrim($_REQUEST['pathtocontroller'], '/');
        $path = filter_var($path, FILTER_SANITIZE_URL);
        $pathArray = explode('/', $path);
    
        return $pathArray;
        }    
    }
}
?>