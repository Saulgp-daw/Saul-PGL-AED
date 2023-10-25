<?php

use App\Http\Controllers\PersonaController;
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

Route::any('/personas', [PersonaController::class,'obtenerPersonas']);
Route::any('/guardar', [PersonaController::class,'guardarPersona']);
Route::any('/personas/{id}', [PersonaController::class,'devolverPersona']);
