<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Http\Controllers\DriveController;

class UsuarioController extends Controller
{
    public function index(){
        return view("registro");
    }

    public function registro(Request $request){
        $nickname = $request->input("nickname");
        $email = $request->input("email");
        $password = $request->input("password");

        $usuario = new Usuario($nickname, $email, $password);
        // var_dump($usuario);
        $request->session()->put("usuario", $usuario);
        return redirect("/home");
    }


}
