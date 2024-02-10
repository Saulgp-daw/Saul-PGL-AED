<?php

namespace App\Http\Controllers;

use App\DAO\MesaDAO;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Reserva;
use App\DAO\ReservaDAO;
use App\Models\Usuario;
use DateTime;

class ReservaController extends Controller
{
    public function index($mensaje = ""){
        // if(!session()->has('usuario_tel')){
        //     return UsuarioController::index("Autentíquese antes de entrar");
        // }
        $telefonoSesion = session()->get('usuario_tel');

        $pdo = DB::getPdo();
        $mesaDao = new MesaDAO($pdo);
        $mesas = $mesaDao->findAll();

        $opciones = [1, 2, 3, 4, 5, 6];

        // foreach($mesas as $mesa){
        //     print_r($mesa->getNum_mesa());
        //     print_r($mesa->get());
        //     echo "<br>";
        // }

        return view("reserva", compact("telefonoSesion", "opciones", "mensaje"));
    }

    public function reserva(Request $request){

        $telefono = $request->input("telefono");
        $duracion = $request->input("duracion");
        $sillas = $request->input("sillas");
        $fecha_hora = $request->input("fecha_hora");

        //echo $telefono. "<br> ". $duracion. "<br> ". $sillas . "<br> ". $fecha_hora;
        $datetime = DateTime::createFromFormat('Y-m-d\TH:i', $fecha_hora);
        if($datetime){
            $fecha_unix = $datetime->getTimestamp();
        }


        $pdo = DB::getPdo();
        $mesaDao = new MesaDAO($pdo);
        $reservaDao = new ReservaDAO($pdo);
        $mesas = $mesaDao->findMesasPorSilla($sillas);
        $reservada = false;
        $mensaje = "No hay mesas";
        if(count($mesas) > 0){
            $mensaje = "Ya hay reservas con esta fecha y hora";
            foreach($mesas as $mesa){
                $nuevaReserva = new Reserva(0, $telefono, $fecha_unix, $duracion, $mesa->getNum_mesa(), "Sin confirmar" );

                if(!$reservada){
                    $solapamiento = $reservaDao->reservasSeSolapan($nuevaReserva);

                    if($solapamiento == 0){
                        $mesaReservada = $reservaDao->save($nuevaReserva);
                        if($mesaReservada){
                            $reservada = true;
                            $mensaje = "Reserva hecha con éxito. Recuerde confirmarla";
                        }
                    }
                }
            }
            //return self::index($mensaje);
        }
        return  redirect('/home')->with('error', $mensaje);
        //$nuevaReserva = new Reserva(0, $telefono, $fecha_unix, $duracion, )
    }

    public function borrar($id){
        $pdo = DB::getPdo();
        $reservaDao = new ReservaDAO($pdo);
        $telefonoSesion = session()->get("usuario_tel");
        echo $telefonoSesion;

        $existe = $reservaDao->findById($id);

        if($existe){
            $borrada = $reservaDao->delete($existe->getId_reserva());
            if($borrada){
                return redirect("/perfil/".$telefonoSesion);
            }
        }
    }
    public function confirmar($id){
        $pdo = DB::getPdo();
        $reservaDao = new ReservaDAO($pdo);
        $telefonoSesion = session()->get("usuario_tel");


        $existe = $reservaDao->findById($id);

        if($existe){
            $existe->setEstado("Confirmada");
            $actualizada = $reservaDao->update($existe);
            if($actualizada){
                return redirect("/perfil/".$telefonoSesion);
            }else{
                echo "Algo fue mal";
            }
        }
    }

    public function modificar($id){
        $pdo = DB::getPdo();
        $reservaDao = new ReservaDAO($pdo);

        $reserva = $reservaDao->findById($id);
        $telefonoSesion = session()->get("usuario_tel");
        $opciones = [1, 2, 3, 4, 5, 6];
        if($reserva){
            return view('modificar', compact('reserva', 'telefonoSesion', 'opciones'));
        }
    }

    public function actualizar(Request $request){
        $id_reserva = $request->input("id_reserva");
        $telefono = $request->input("telefono");
        $duracion = $request->input("duracion");
        $sillas = $request->input("sillas");
        $fecha_hora = $request->input("fecha_hora");
        $telefonoSesion = session()->get('usuario_tel');

        //echo $telefono. "<br> ". $duracion. "<br> ". $sillas . "<br> ". $fecha_hora;
        $datetime = DateTime::createFromFormat('Y-m-d\TH:i', $fecha_hora);
        if($datetime){
            $fecha_unix = $datetime->getTimestamp();
        }

        $pdo = DB::getPdo();
        $mesaDao = new MesaDAO($pdo);
        $reservaDao = new ReservaDAO($pdo);
        $mesas = $mesaDao->findMesasPorSilla($sillas);
        $reservada = false;
        $mensaje = "Ya hay reservas con esta fecha y hora";
        if(count($mesas) > 0){
            foreach($mesas as $mesa){
                $nuevaReserva = new Reserva($id_reserva, $telefono, $fecha_unix, $duracion, $mesa->getNum_mesa(), "Sin confirmar" );

                if(!$reservada){
                    $solapamiento = $reservaDao->reservasSeSolapan($nuevaReserva);

                    if($solapamiento == 0){
                        $mesaReservada = $reservaDao->update($nuevaReserva);
                        if($mesaReservada){
                            $reservada = true;
                            $mensaje = "Reserva modificada con éxito. Recuerde confirmarla";
                        }

                    }
                }
            }
            return  redirect('/modificar_form/'.$id_reserva)->with('error', $mensaje);
        }
    }

}
