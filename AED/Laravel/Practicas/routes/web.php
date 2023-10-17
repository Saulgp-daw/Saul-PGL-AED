<?php

use App\Http\Controllers\ListaProductos;
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

//Practica04
Route::get('/', function () {
    //echo "página raíz de nuestra aplicación";
});


//Practica05
Route::get('/', function () {
    ListaProductos::ejecutaGET();
});

Route::post('/', function () {
    ListaProductos::ejecutaPOST();
});
