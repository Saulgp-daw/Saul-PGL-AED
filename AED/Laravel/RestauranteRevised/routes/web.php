<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ReservaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::any('/', [UsuarioController::class, "index"]);
Route::get('/registro_form', [UsuarioController::class, "index"]);
Route::post('/registro', [UsuarioController::class, "registro"]);
Route::get('/login_form', [UsuarioController::class, "loginForm"]);
Route::get('/logout', [UsuarioController::class, "logout"]);
Route::post('/login', [UsuarioController::class, "login"]);
Route::get('/home', [ReservaController::class, "index"]);
Route::post('/reserva', [ReservaController::class, "reserva"]);
Route::get('/perfil/{telefono}', [UsuarioController::class, "perfil"]);
Route::delete('/borrar/{id}', [ReservaController::class, "borrar"]);
Route::put('/confirmar/{id}', [ReservaController::class, "confirmar"]);
