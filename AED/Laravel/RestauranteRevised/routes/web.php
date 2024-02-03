<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;

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

Route::any('/', [UsuarioController::class, "registroForm"]);
Route::get('/registroForm', [UsuarioController::class, "registroForm"]);
Route::post('/registro', [UsuarioController::class, "registro"]);
Route::get('/loginForm', [UsuarioController::class, "loginForm"]);
Route::post('/login', [UsuarioController::class, "login"]);
