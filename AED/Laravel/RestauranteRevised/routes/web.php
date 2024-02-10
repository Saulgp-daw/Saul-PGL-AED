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
Route::get('/login_form', [UsuarioController::class, "loginForm"]);
Route::get('/logout', [UsuarioController::class, "logout"]);


Route::post('/registro', [UsuarioController::class, "registro"]);
Route::get('/registro', function () {
    return redirect('/home')->with('error', 'Operación no permitida.');
});
Route::post('/login', [UsuarioController::class, "login"]);
Route::get('/login', function () {
    return redirect('/home')->with('error', 'Operación no permitida.');
});

Route::post('/reserva', [ReservaController::class, "reserva"]);
Route::get('/reserva', function () {
    return redirect('/home')->with('error', 'Operación no permitida.');
});

Route::delete('/borrar/{id}', [ReservaController::class, "borrar"]);
Route::get('/borrar/{id}', function () {
    return redirect('/home')->with('error', 'Operación no permitida.');
});
Route::put('/confirmar/{id}', [ReservaController::class, "confirmar"]);
Route::get('/confirmar/{id}', function () {
    return redirect('/home')->with('error', 'Operación no permitida.');
});

Route::put('/modificar', [ReservaController::class, "actualizar"]);
Route::get('/modificar', function () {
    return redirect('/home')->with('error', 'Operación no permitida.');
});


Route::group(['middleware' => ['redirectIfNotAuthorized']], function () {
    Route::get('/home', [ReservaController::class, "index"]);
    Route::get('/perfil/{telefono}', [UsuarioController::class, "perfil"]);
    Route::get('/modificar_form/{id}', [ReservaController::class, "modificar"]);
    Route::get('/lista_usuarios', [UsuarioController::class, "listaUsuarios"]);
});
