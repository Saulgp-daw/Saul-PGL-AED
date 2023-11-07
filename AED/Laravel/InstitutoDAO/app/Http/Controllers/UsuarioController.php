<?php

namespace App\Http\Controllers;

use App\DAO\UsuarioDAO;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    public static function index($mensaje = "")
    {
        return view("registro", compact("mensaje"));
    }

    public function registro(Request $request)
    {
        $nickname = $request->input("nickname") ?? "";
        $password = $request->input("password") ?? "";

        $pdo = DB::getPdo();
        $usuarioDAO = new UsuarioDAO($pdo);

        $mensaje = "Este nick ya está escogido";

        if (!$usuarioDAO->checkIfnicknameExists($nickname) && trim($nickname) != "" && trim($password) != "") {
            $filasAfectadas = $usuarioDAO->register(trim($nickname), password_hash(trim($password), PASSWORD_DEFAULT));

            if ($filasAfectadas) {
                $mensaje = "Usuario registrado con éxito";
            }
        }

        return self::index($mensaje);
    }

    public static function loginView($mensaje = "")
    {
        return view("login", compact("mensaje"));
    }

    public function login(Request $request)
    {
        $nickname = $request->input("nickname") ?? "";
        $password = $request->input("password") ?? "";

        $pdo = DB::getPdo();
        $usuarioDAO = new UsuarioDAO($pdo);

        $mensaje = "Error al acceder";
        if (trim($nickname) != "" && trim($password) != "") {

            $credencialesCorrectas = $usuarioDAO->login(trim($nickname), trim($password));
            if ($credencialesCorrectas) {
                session(['usuario' => $nickname]);
                return redirect("/home");
            }
        }
        return self::loginView($mensaje);
    }

    public function logout(Request $request)
    {
        session()->flush();
        return self::index();
    }
}
