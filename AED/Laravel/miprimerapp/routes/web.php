<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('/', function () {
    echo "Eso es todo amigos!";
    die();
    return view('welcome');
});

Route::get('/anacardos', function(){
    echo "Estamos saludando un poco";
    die();
} );


Route::get('/goodbye', function () {
    return view('goodbye');
});

Route::post('/pruebita', function () {
    echo "Se ha ejecutado una petición post";
});

Route::match(['get', 'post'], '/getypost', function(){
    echo "Responde a get y post";
});


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
