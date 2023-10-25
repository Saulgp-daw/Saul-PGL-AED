<?php

use App\Http\Controllers\DriveController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

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

Route::any('/', [UsuarioController::class, "index"]);
Route::any('/home', [DriveController::class, "index"]);
Route::any('/descargar/{archivo}', [DriveController::class, "descargar"]);
Route::any('/borrar/{archivo}', [DriveController::class, "borrar"]);
Route::any('/registro', [UsuarioController::class, "registro"]);
