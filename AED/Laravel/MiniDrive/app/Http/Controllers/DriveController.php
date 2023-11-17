<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DriveController extends Controller
{
    private static $rutaBaseFicheros = "/Archivos/";
    private static $rutaZonaCompartida = "/zonacompartida/";

    public static function index($usuario = null)
    {
        if ($usuario != null) {
            session(['usuario' => $usuario]);
            Storage::makeDirectory("/Archivos/" . $usuario, 0755, true);

            return self::home();
        } else {
            echo "No hay usuario registrado";
        }
    }

    public static function home($mensaje = "")
    {
        $usuario = session('usuario');
        if ($usuario) {
            $ficheros = Storage::files("/Archivos/" . $usuario);
            $carpetas = Storage::directories("/Archivos/" . $usuario);
            $compartidos = Storage::allFiles("/zonacompartida/");
            return view("drive", compact("ficheros", "usuario", "mensaje", "carpetas", "compartidos"));
        } else {
            echo "No hay usuario loggeado";
        }
    }

    public function subir(Request $request)
    {
        $mensaje = "";
        if ($request->archivo) { //otra manera de recogerlo, 'archivo' es el name del formulario
            $archivo = $request->file('archivo');
            $nombreFichero = $archivo->getClientOriginalName(); // Muestra el nombre original del archivo
            $nombreUsuario = session('usuario');
            //echo "Ruta base ". self::$rutaBaseFicheros;
            //echo "Nombre de usuario ". $nombreUsuario;
            $path = $archivo->storeAs(self::$rutaBaseFicheros . "/" . $nombreUsuario, $nombreFichero);
            //echo $path;
            $mensaje = 'Fichero subido con éxito';
            echo '<br>';
        } else {
            $mensaje = 'No se ha subido ningún archivo.';
        }
        return self::home($mensaje);
    }

    public function subircompartida(Request $request)
    {
        $mensaje = "";
        if ($request->archivo) { //otra manera de recogerlo, 'archivo' es el name del formulario
            $archivo = $request->file('archivo');
            $nombreFichero = $archivo->getClientOriginalName(); // Muestra el nombre original del archivo
            //$nombreUsuario = session('usuario');
            //echo "Ruta base ". self::$rutaBaseFicheros;
            //echo "Nombre de usuario ". $nombreUsuario;
            $path = $archivo->storeAs(self::$rutaZonaCompartida."/".$nombreFichero);
            //echo $path;
            $mensaje = 'Fichero subido con éxito';
            echo '<br>';
        } else {
            $mensaje = 'No se ha subido ningún archivo.';
        }
        return self::home($mensaje);
    }

    public function descargar($archivo)
    {
        $usuario = session('usuario');
        $mensaje = "";
        $rutaUsuario = "/Archivos/" . $usuario . "/" . $archivo;
        if (Storage::exists($rutaUsuario)) {
            //otra manera: storage_path("app/Archivos/" . $archivo)
            return response()->download(storage_path("app/".$rutaUsuario));
        }else{
            $mensaje = "No existe el archivo";
        }
    }

    public function descargarCompartida($archivo)
    {
        $usuario = session('usuario');
        $mensaje = "";
        $rutaUsuario = "/zonacompartida/" . $archivo;
        if (Storage::exists($rutaUsuario)) {
            //otra manera: storage_path("app/Archivos/" . $archivo)
            return response()->download(storage_path("app/".$rutaUsuario));
        }else{
            $mensaje = "No existe el archivo";
        }
    }

    public function borrar($archivo)
    {
        $usuario = session('usuario');
        $mensaje = "";
        $rutaUsuario = "Archivos/" . $usuario . "/" . $archivo;
        if ($usuario) {
            if (Storage::exists($rutaUsuario)) {
                Storage::delete($rutaUsuario);
                $mensaje = "Archivo borrado";
            }
        }

        return self::home($mensaje);
    }

    public function borrarCompartido($archivo)
    {
        $usuario = session('usuario');
        $mensaje = "";
        $rutaUsuario = "zonacompartida/" . $archivo;
        if ($usuario) {
            if (Storage::exists($rutaUsuario)) {
                Storage::delete($rutaUsuario);
                $mensaje = "Archivo borrado";
            }
        }

        return self::home($mensaje);
    }

    public static function guardarUsuario($usuario)
    {
        $rutaRegistros = "Archivos/registros.csv";
        if (Storage::exists($rutaRegistros)) {
            //echo "Existe, toma: ". $usuario->getEmail();
            //die();
            $contenidoFichero = Storage::disk('local')->get($rutaRegistros) ?? '';
            $contenidoActualizado = $contenidoFichero .  $usuario->getNickname() . ";" . $usuario->getEmail() . ";" . $usuario->getPassword() . PHP_EOL; //EOL representa el fin de una línea
            Storage::disk('local')->put($rutaRegistros, $contenidoActualizado);
        }
    }


}
