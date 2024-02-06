<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\UsuarioController;

class RedirectIfNotAuthorized
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if(!session()->has('usuario_tel')){
            return redirect('/registro_form')->with('error', 'Autentíquese antes de entrar');
        }
        return $next($request);
    }
}
