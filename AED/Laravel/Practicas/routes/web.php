<?php

use App\Http\Controllers\FechaController;
use App\Http\Controllers\ListaProductos;
use App\Http\Controllers\NumerosController;
use App\Http\Controllers\PrimosController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
Route::get('/', function () {
    return view('under_construction');
});
*/
//Practica02
Route::post('/pruebita', function () {
    echo "Se ha ejecutado una paetición post";
});

//Si se intenta acceder por GET dice que no lo soporta e intentarlo por POST


//Practica03
Route::any('relatos/{numero}', function ($numero) {
    echo "petición recibida para
    el parámetro: " . $numero;
    exit();
});

/*
//Practica04
Route::get('/', function () {
    //echo "página raíz de nuestra aplicación";
});
*/

//Practica05
Route::any('/', [ListaProductos::class, 'respuesta']);

/**
 * Práctica6 funciona gracias a Inteliphense
 * @var bool
 */


//Practica 7
Route::any('/primos', [PrimosController::class,'mostrarPrimos']);

//Práctica 8
Route::any('/fecha', [FechaController::class,'mostrarFecha']);

//Práctica 9
Route::any('/fecha_desde', [FechaController::class,'desde']);

//Practic10
Route::any("/numeros", [NumerosController::class, 'mostrarVista']);

